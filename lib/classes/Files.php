<?php

class Files 
{
  private string $username;
  private string $DIRNAME = "E:\Project/PRO-P4/assets/img/users-img/";
  public function __CONSTRUCT($username) {
    $this->username = $username;
  }
  public function makeDir() {
    if(!is_dir($this->DIRNAME. $this->username)) {
      mkdir($this->DIRNAME. $this->username);
      mkdir($this->DIRNAME. $this->username. '/pfp');
      return $this->DIRNAME. $this->username;
    }
  }
  public function remDir() {
    if(is_dir($this->DIRNAME. $this->username)) {
      rmdir($this->DIRNAME. $this->username);
    }
  }
  public function renameImage($img) {
    
  }
}