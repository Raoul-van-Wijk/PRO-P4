<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/classes/Chat.php';


$chat = new Chat();

switch ($_POST['func']) {
  case 'send-msg': 
    $chat->sendMsg($_POST['toUser'], $_POST['msg'], $_POST['userID']);
    break;

  case 'get-msg':
    $user = $chat->getUser($_POST['fromUser']);
    echo "<div class='chat-header'>
            <img src='' alt=''>
            <p data-toUser='{$user['userID']}'>{$user['username']}</p>
          </div>";
    $msg = $chat->getMsg($_POST['UserID'], $_POST['fromUser']);
    while ($row = $msg->fetch()) {
      if($row['FromUserID'] == $_POST['UserID']) {
        echo "<div class='fromUser'>{$row['Message']}</div>";
      } else {
        echo "<div class='toUser'>{$row['Message']}</div>";
      }
    }

    break;

  case 'commentUser':
    $chat->commentUser($_POST['toUser']);
    break;

    default:
    return false;
    break;
}
