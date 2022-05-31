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
            var_dump($loginCredentials);exit;
            $mkNewProfile = new ProfileCustomization($loginCredentials['userID']);
            $mkNewProfile->addUserProfile();
          } elseif ($loginCredentials['firstLogin'] == 2 || $loginCredentials['firstLogin'] == 3) {
            header("location: ".URLROOT."page/ban");
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

  public function timeoutUser($id) {
    $status = self::userStatus($id);

    $sql = '';

    if($status[0]['firstLogin'] == 0) {
      $sql = "UPDATE `users` SET `firstLogin` = 2 where `userID` = :id";
    } elseif ($status[0]['firstLogin'] == 2) {
      $sql = "UPDATE `users` SET `firstLogin` = 0 where `userID` = :id";
    }

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Refresh: 1; ". URLROOT ."page/main/dashboard");
    return "succesfully timed-out user";
  }

  public function userStatus($id) {
    $sql = "SELECT `firstLogin` FROM `users` where `userID` = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}