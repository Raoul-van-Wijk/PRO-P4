<?php
declare(strict_types=1);
require_once '1Config.php';


// Class chat
  class Chat extends Config {
    private int $userID;
    public function __Construct(int $userID = 0) {
      $this->userID = $userID;
    }

    public function sendMsg(int | string $toUser, string $message, $userID) {
      if(isset($message) && isset($toUser)) {
        $fromUser = $userID;
        $sql = "INSERT INTO `chat` (`chatID`, `FromUserID`, `ToUserID`, `Message`) VALUES (NULL, :fromuser, :toUser, :message)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':fromuser', $fromUser, PDO::PARAM_INT);
        $stmt->bindParam(':toUser', $toUser, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        if ($stmt->execute()) {
          // succesfully sendMsg
        } else {
          // something went wrong
        }
      }
    }

    public function getMsg($userID, $fromUser) {
      if(isset($fromUser)) {
        $toUser = $userID;
        // echo "SELECT * FROM `chat` WHERE FromUserID = {} AND ToUserID = :ToUserID OR FromUserID = :ToUserID AND ToUserID = :FromUserID";
        $sql1 = "SELECT * FROM `chat` WHERE FromUserID = :FromUserID AND ToUserID = :ToUserID OR FromUserID = :ToUserID AND ToUserID = :FromUserID";
        $stmt1 = $this->connect()->prepare($sql1);
        $stmt1->bindParam(':FromUserID', $fromUser);
        $stmt1->bindParam(':ToUserID', $toUser);
        if($stmt1->execute()) {
          return $stmt1;
        }

        }
      }

    public function getFriends() {
      if(isset($this->userID)) {
        $sql = "SELECT fuserID, friendUserId as frID, username FROM userfriends INNER JOIN users on friendUserID = userID WHERE fuserID = :userID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':userID', $this->userID);
        if($stmt->execute()) {
          // success
          return $stmt;
        } else {
          // something went wrong
        }
      }
    }


    public function getUser($userID) {
      $sql = "SELECT usr.userID as userID ,usr.username as username, upf.profilePicture as pfp FROM `userprofile` upf INNER JOIN users usr on usr.userID = upf.userID WHERE upf.userID = :userID";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':userID', $userID);
      if($stmt->execute()) {
        while($row = $stmt->fetch()) {
          return $row;
        }
      }
    }
  }
