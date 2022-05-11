<?php

if (!isset($_POST['func'])) { return false;}
if (!isset($_SESSION['userID'])) { return false;}
$chat = new Chat($_SESSION['userID']);
switch ($_POST['func']) {
  case 'send-msg':
    $chat->sendMsg($_POST['toUser'], $_POST['message']);
    break;
  case 'get-msg':
    $chat->getMsg($_POST['toUser']);
    break;
  case 'commentUser':
    $chat->commentUser($_POST['toUser']);
    break;
    default:
    return false;
    break;
}