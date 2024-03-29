<?php

class ProfileCustomization extends Config
{
  private int $userID;
  private string $bio;
  private string $pfp;
  private string $bgimg;
  public function __Construct($userID = 0, $bio = '', $pfp = '', $bgimg = '') {
    $this->userID = $userID;
    $this->bio = $bio;
    $this->pfp = $pfp;
    $this->bgimg = $bgimg;
  }
  // add User Profile function
  public function addUserProfile() {
    if(empty($this->userID)) {
      //user is not logged in
    }
    if(!empty($this->userID)) {
      $sql = "INSERT INTO `userprofile` (`userID`, `profilePicture`, `bio`, `backGroundImage`) VALUES (:userID, NULL, NULL, NULL)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':userID', $this->userID);
      if($stmt->execute()) {
        // succesfully made a new user Profile
        $sql = "UPDATE `users` SET `firstLogin` = '0' WHERE `users`.`userID` = :userID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':userID', $this->userID);
        if($stmt->execute()) {
          //succes
        }
      } else {
        // something went wrong
      }
    }
  }
  // change bio function
  public function updateBio($bio) {
    $this->bio = $bio;
    if(empty($this->bio) || !isset($_SESSION['userID'])) return false;
    if(!empty($this->bio) || isset($_SESSION['userID'])) {
      $sql = "UPDATE `userprofile` SET `bio` = :bio WHERE `userprofile`.`userID` = :userID";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(":bio", $this->bio);
      $stmt->bindParam(":userID", $this->userID);
      if($stmt->execute()) {
        // succesfully updated bio
        return true;
      } else {
        // something went wrong
        return false;
      }
    }
  }

  // change pfp function
  public function updateProfilePicture($pfp) {
    if(empty($pfp) || !isset($_SESSION['userID'])) {
      // pfp is empty
    }
    if(!empty($pfp) || isset($_SESSION['userID'])) {
      $sql = "UPDATE `userprofile` SET `profilePicture` = :pfp WHERE `userprofile`.`userID` = :userID";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(":pfp", $pfp);
      $stmt->bindParam(":userID", $this->userID);
      if($stmt->execute()) {
        return true;
        // succesfully updated pfp
      } else {
        return false;
        // something went wrong
      }
    }
  }

  // change backgroundImage function
  public function UpdateBackgroundImage($bgimg) {
    $this->bgimg = $bgimg;
    if(empty($this->bgimg) || !isset($_SESSION['userID'])) {
      // bgimg is empty
    }
    if(!empty($this->bgimg) || isset($_SESSION['userID'])) {
      $sql = "UPDATE `userprofile` SET `backGroundImage` = :bgimg WHERE `userprofile`.`userID` = :userID";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(":bgimg", $this->bgimg);
      $stmt->bindParam(":userID", $this->userID);
      if($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }

  public function getUserProfile() {
    $sql = "SELECT * FROM `userprofile` WHERE `userprofile`.`userID` = :userID";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(":userID", $this->userID);
    if($stmt->execute()) {
      $result = $stmt->fetchAll();
      return $result;
    }
  }

  public function checkProfilePicture($profilePicture) {
    if(is_null($profilePicture)) return '../../assets/img/logo.png';
    if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$profilePicture)) return '../../assets/img/logo.png';
    return '../../'.$profilePicture;
  }

  public function checkBanner($backGroundImage) {
    if(is_null($backGroundImage) || empty($backGroundImage)) return '../../assets/img/default-banner.jpg';
    if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$backGroundImage)) return '../../assets/img/default-banner.jpg';
    return '../../'.$backGroundImage;
  }


  public function makeComment(int $profile, string $message)
  {
    $sql = "INSERT INTO `comment` (`profileID`, `userID`, `message`, `date`) VALUES (:profileID, :userID, :message, :date)";
    $stmt = $this->connect()->prepare($sql);
    $currentDate = date('Y-m-d H:i:s');
    $stmt->bindParam(":profileID", $profile);
    $stmt->bindParam(":userID", $this->userID);
    $stmt->bindParam(":message", $message);
    $stmt->bindParam(":date", $currentDate);
    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public function getComments($profileID) {
    $sql = "SELECT * FROM `comment` WHERE `comment`.`profileID` = :profileID";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(":profileID", $profileID);
    try {
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }
}