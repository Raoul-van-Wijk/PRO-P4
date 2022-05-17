<?php

class Files 
{

  private string $username;
  private string $DIRNAME =   "/assets/img/users-img/";
  
  public function __CONSTRUCT($username = '') {
    $this->username = $username;
  }
  public function makeDir() {
    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username)) {
      mkdir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username);
      mkdir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username. '/pfp');
      return $_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username;
    }
  }
  
  public function remDir() {
    if(is_dir($this->DIRNAME. $this->username)) {
      rmdir($this->DIRNAME. $this->username);
    }
  }
  public function renameImage($img) {
    move_uploaded_file($tmpname, 'test/'. $newname);
  }
}





// if (isset($_POST['submit'])) {
//   $PFC = new ProfileCustomization($_SESSION['userID'], $_FILES);
//   $PFC->updateProfilePicture();
// }