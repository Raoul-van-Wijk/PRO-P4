<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/classes/Chat.php';
$chat = new Chat(1);

if (!isset($_POST['func'])) { return false;}
if (!isset($_SESSION['userID'])) { return false;}
$chat = new Chat($_SESSION['userID']);

switch ($_POST['func']) {
  case 'send-msg': 
    $chat->sendMsg($_POST['toUser'], $_POST['msg']);
    break;
  case 'get-msg':
    $chat->getMsg($_POST['fromUser']);
    break;
  case 'commentUser':
    $chat->commentUser($_POST['toUser']);
    break;
    default:
    return false;
    break;
}