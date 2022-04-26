<?php
class Users extends Database {
  public function getUsers() {
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->query($sql);
    while($row = $stmt->fetch()) {
      echo $row['username'].'</br>';
    }
  }

  function registerNewUser($username, $password):void {  
    if(empty($username) || empty($password)) {
      echo "One or more fields are empty";
      header("Refresh: 2; index.php?page={$_GET['page']}&lr=register");
    } else {
      $sql = "INSERT INTO `users` (`userID`, `username`, `password`) VALUES (NULL, :username, :password)";
      $stmt = $this->connect()->prepare($sql);
      $pwh = password_hash($password, PASSWORD_BCRYPT);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $pwh);
      if($stmt->execute()) {
        echo "Succesfully created a new user";
      } else {
        echo "An error occured";
      }
      header('Refresh: 3; index.php?page=home');
    }
  }

  public function loginUsers($username, $password) {
    if(isset($_SESSION['userID'])) {
      echo "Already logged in";
      header("Refresh: 2; index.php?page=home");
      return false;
    }
    if(empty($username) || empty($password)) {
      echo "One or more fields are empty";
      header('Refresh: 2; index.php?page=register');
    } else {
      $sql = "SELECT * FROM `users` WHERE `username` = :username";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0) {
        echo "User does not exist";
        header('Refresh: 2; index.php?page=register');
      } else {
        $loginCredentials = $stmt->fetch();
        if(!password_verify($password, $loginCredentials['password'])) {
          echo "Password does not match";
          header('Refresh: 2; index.php?page=login');
        } else {
          echo 'You succesfully logged in';
          $_SESSION['userID'] = $loginCredentials['userID'];
          $_SESSION['username'] = $username;
          header("Refresh: 2; index.php?page=home");
        }
      }
    }
  }

  public function logoutUser():void {
    session_destroy();
    echo "succesfully logged out";
    header("Refresh: 1; index.php?page=home");
  }
}