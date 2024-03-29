<?php

class Users extends Config {
  public function getUsers() {
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->query($sql);
    $rows = $stmt->fetchAll();
    return $rows;
  }

  function registerNewUser($username, $password, $age) {  
    if(empty($username) || empty($password)) {
      header("Refresh: 2; ".URLROOT."page/lr/register");
      return "One or more fields are empty";
    } else {
      $sql = "INSERT INTO `users` (`userID`, `username`, `password`, `age`) VALUES (NULL, :username, :password, :age)";
      $stmt = $this->connect()->prepare($sql);
      $pwh = password_hash($password, PASSWORD_BCRYPT);
      $files = new Files($username);
      $files->makeDir();
    

      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $pwh);
      $stmt->bindParam(':age', $age);
      if($stmt->execute()) {
        header("Refresh: 3; ".URLROOT."page/lr/login");
        return "Succesfully created a new user";
      } else {
        header("Refresh: 3; ".URLROOT."page/lr/login");
        return "An error occured";
      }
      header("Refresh: 3; ".URLROOT."page/lr/login");
    }
  }

  public function loginUsers($username, $password) {
    if(isset($_SESSION['userID'])) {
      header("Refresh: 2; ".URLROOT."page/main/dashboard");
      return "Already logged in";
    }
    if(empty($username) || empty($password)) {
      header("Refresh: 2; ".URLROOT."page/lr/register");
      return "One or more fields are empty";
    } else {
      $sql = "SELECT * FROM `users` WHERE `username` = :username";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0) {
        header("Refresh: 2; ".URLROOT."page/lr/register");
        return "User does not exist";
      } else {
        $loginCredentials = $stmt->fetch();
        if(!password_verify($password, $loginCredentials['password'])) {
          header("Refresh: 2; ".URLROOT."page/lr/login");
          return "Password does not match";
        } else {
          if($loginCredentials['firstLogin'] == 1) {
            var_dump($loginCredentials);
            $mkNewProfile = new ProfileCustomization($loginCredentials['userID']);
            $mkNewProfile->addUserProfile();
          } elseif ($loginCredentials['firstLogin'] == 2) {
            echo 'Timeout until: ';
            echo $loginCredentials['timeoutTime'];
            $timestamp = strtotime('+2 hour'); 
            $hourMin = date('H:i', $timestamp);
            if($loginCredentials['timeoutTime'] <= $hourMin) {
              $this->timeoutUser($loginCredentials['userID'], false);
            } else {
              exit();
            }

            //exit();
          } elseif ($loginCredentials['firstLogin'] == 3) {
            echo 'You are banned!';
            exit();
          }
          $_SESSION['userID'] = $loginCredentials['userID'];
          $_SESSION['username'] = $username;
          $_SESSION['userrole'] = $loginCredentials['userrole'];
          header("Refresh: 2; ".URLROOT."page/main/dashboard");
          return 'You succesfully logged in';
        }
      }
    }
  }

  public function logoutUser() {
    session_destroy();
    header("Refresh: 1; ". URLROOT ."page/lr/login");
    return "succesfully logged out";
  }

  public function deleteUser($id) {
    $sql = "DELETE FROM `users` where `userID` = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Refresh: 1; ". URLROOT ."page/main/dashboard");
    return "succesfully removed user";
  }

  public function getUserByID($id) {
    $sql = "SELECT * FROM users WHERE userID = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }

  public function timeoutUser($id, $time) {
    $status = self::userStatus($id);

    $sql = "SELECT * FROM `users` WHERE `userID` = :id";

    $timestamp = strtotime('+' . 2+$time . ' hour'); 
    $hourMin = date('H:i', $timestamp); 

    $sql_t = false;

    if($status[0]['firstLogin'] == 0) {
      $sql = "UPDATE `users` SET `firstLogin` = 2, `timeoutTime` = :time where `userID` = :id";
      $sql_t = true;
    } elseif ($status[0]['firstLogin'] == 2) {
      $sql = "UPDATE `users` SET `firstLogin` = 0, `timeoutTime` = 0 where `userID` = :id";
    } elseif ($status[0]['firstLogin'] == 3) {
      header("Refresh: 1; ". URLROOT ."page/main/adminDashboard");
    }
    $stmt = $this->connect()->prepare($sql);
    if($sql_t) {
      $stmt->bindParam(':time', $hourMin);
    }

    $stmt->bindParam(':id', $id);

    $stmt->execute();
    header("Refresh: 1; ". URLROOT ."page/main/adminDashboard");
    return "succesfully timed-out user";
  }

  public function banUser($id) {
    $status = self::userStatus($id);

    $sql = "SELECT * FROM `users` WHERE `userID` = :id";

    if($status[0]['firstLogin'] == 0) {
      $sql = "UPDATE `users` SET `firstLogin` = 3 where `userID` = :id";
    } elseif ($status[0]['firstLogin'] == 3) {
      $sql = "UPDATE `users` SET `firstLogin` = 0 where `userID` = :id";
    } elseif ($status[0]['firstLogin'] == 2) {
      header("Refresh: 1; ". URLROOT ."page/main/adminDashboard");
    }

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Refresh: 1; ". URLROOT ."page/main/adminDashboard");
    return "succesfully banned user";
  }

  public function userStatus($id) {
    $sql = "SELECT `firstLogin` FROM `users` where `userID` = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function likeUser($username) {
    $sql = "SELECT * FROM `userprofile` WHERE `userID` = (SELECT `userID` FROM `users` WHERE `username` = :username)";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $userID = $row[0]['userID'];
    $likes = $row[0]['likes'] += 1;

    $sql = "UPDATE `userprofile` SET `likes` = :likes WHERE `userID` = :userID";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':likes', $likes);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    return $likes;
  }

  public function checkFriendship($currentUser, $userID)
  {
    $sql = "SELECT * FROM `userfriends` WHERE `fuserID` = :userID AND `friendUserID` = :friendID";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':friendID', $currentUser);
    $stmt->execute();
    // $row = $stmt->fetchAll();
    if($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function changeFriend($userID, $friend, $action)
  {
    if($action == 'add') {
      $sql = "INSERT INTO `userfriends` (`friendID`, `fuserID`, `friendUserID`) VALUES (NULL, :userID, :friendUserID)";
    } elseif ($action == 'remove') {
      $sql = "DELETE FROM `userfriends` WHERE `fuserID` = :userID AND `friendUserID` = :friendUserID";
    }
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':friendUserID', $friend);
    try {
      $stmt->execute();
      return 'succes';  
    } catch (PDOException $e) {
      echo $e->getMessage();
      return 'something went wrong';
    }
  }
}
