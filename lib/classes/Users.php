<?php

class Users extends Config {
  public function getUsers() {
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->query($sql);
    while($row = $stmt->fetch()) {
      return $row['username'].'</br>';
    }
  }

  function registerNewUser($username, $password, $age) {  
    if(empty($username) || empty($password)) {
      return "One or more fields are empty";
      header("Refresh: 2; ".URLROOT."page/lr/register");
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
        return "Succesfully created a new user";
      } else {
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
            $mkNewProfile = new ProfileCustomization($loginCredentials['userID']);
            $mkNewProfile->addUserProfile();
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
    return "succesfully logged out";
    header("Refresh: 1; ". URLROOT ."page/lr/login");
  }
}