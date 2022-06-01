<?php

class Files 
{

  private string $username;
  private string $DIRNAME =   "/assets/img/users-img/";
  private array $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF', 'svg', 'SVG', 'bmp', 'BMP', 'webp', 'WEBP', 'tif', 'TIF', 'tiff', 'TIFF');

  
  public function __CONSTRUCT($username = '') {
    $this->username = $username;
  }
  public function makeDir() {
    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username)) {
      mkdir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username);
      // mkdir($_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username. '/pfp');
      return $_SERVER['DOCUMENT_ROOT'] . $this->DIRNAME. $this->username;
    }
  }
  
  public function remDir() {
    if(is_dir($this->DIRNAME. $this->username)) {
      rmdir($this->DIRNAME. $this->username);
    }
  }
  public function renameImage($img) {
    $tmpname = $img['tmp_name'];
    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
    if(!in_array($extension, $this->allowedExtensions)) { return false; }
    $newname = $this->username . '-' . $img['name'];
    if(move_uploaded_file($tmpname, 'assets/img/users-img/'. $this->username .'/'. $newname)) {
      return 'assets/img/users-img/'. $this->username .'/'. $newname;
    } else {
      return false;
    }
  }
}





// if (isset($_POST['submit'])) {
//   $PFC = new ProfileCustomization($_SESSION['userID'], $_FILES);
//   $PFC->updateProfilePicture();
// }