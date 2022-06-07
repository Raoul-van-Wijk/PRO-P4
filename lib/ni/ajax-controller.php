<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/classes/Chat.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/classes/Users.php';


$chat = new Chat();
$user = new Users();

switch ($_POST['func']) {
  case 'send-msg': 
    if(!empty($_POST['msg'])) {
      $chat->sendMsg($_POST['toUser'], $_POST['msg'], $_POST['userID']);
    }
    
    break;

  case 'get-msg':
    if($_POST['fromUser'] == 'NaN') {
      echo $_POST['fromUser'];exit;
    }
    $user = $chat->getUser($_POST['fromUser']);
    // echo "<div class='chat-header'>
    //         <img src='../../assets/img/logo.PNG' alt='Profile picture'>
    //         <p data-toUser='{$user['userID']}'>{$user['username']}</p>
    //       </div>
    //       ";
    $msg = $chat->getMsg($_POST['UserID'], $_POST['fromUser']);
    echo "<div class='msg'>";
    while ($row = $msg->fetch()) {
      if($row['FromUserID'] == $_POST['UserID']) {
        echo "<div class='send'>
                <p>{$row['Message']}</p>
              </div>";
      } else {
        echo "<div class='receive'>
        <p>{$row['Message']}</p>
      </div>";
      }
    }
    echo "</div>";
    break;
  case "like-user":
    $likes = $user->likeUser($_POST['username']);
    echo $likes;
    break;
    case 'commentUser':
      // $chat->commentUser($_POST['toUser']);
      break;

    default:
    return false;
    break;

}

// {$user['pfp']}

// <div class="send">
//   <p>i send a message</p>
//   </div>
//   <div class="receive">
//   <p>you got a message asfljs lkdjf lksjdf lkdafj lkdf dkd kdf kskdfkjd fj dfkkf dfk dkfjdfjdf df salls sldfk
//     slkf</p>
//   </div>
//   </div>
//   <div class="send-message">
//   <input data-message-input type="text" placeholder="type here...">
//   <button data-message-button>send</button>