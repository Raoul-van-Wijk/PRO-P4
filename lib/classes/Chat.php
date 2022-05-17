<?php
require_once '1Config.php';
// Class for chat
  class Chat extends Config {
    private int $userID;
    public function __Construct(int $userID) {
      $this->userID = $userID;
    }

    public function sendMsg($toUser) {

    }

    public function getMsg($toUser) {
      
    }

    public function commentUser($toUser) {

    }
  }
