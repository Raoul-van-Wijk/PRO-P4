<?php

class ProfileCustomization extends Config
{
  private int $userID;
  private string $bio;
  private string $pfp;
  private string $bgimg;
  public function __Construct($userID, $bio = '', $pfp = '', $bgimg = '') {
    $this->userID = $userID;
    $this->bio = $bio;
    $this->pfp = $pfp;
    $this->bgimg = $bgimg;
  }
  // add User Profile function
  public function addUserProfile() {
    if(!empty($this->userID)) {
      //user is not logged in
    }
    if(!empty($this->userID)) {
      $sql = "INSERT INTO `userprofile` (`userID`, `profilePicture`, `bio`, `backGroundImage`) VALUES (:userID, NULL, NULL, NULL)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':userID', $this->userID);
      if($stmt->execute()) {
        // succesfully made a new user Profile
      } else {
        // something went wrong
      }
    }
  }

  // change bio function

  // change pfp function

  // change backgroundImage function
}