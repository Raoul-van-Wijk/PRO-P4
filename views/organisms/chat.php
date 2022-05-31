
<div class="aside">
      <button data-open-aside class="oa">
        <div class="icon">
          <svg class="back" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 20L0 10L10 0L11.3125 1.3125L3.5625 9.0625H20V10.9375H3.5625L11.3125 18.6875L10 20Z"
              fill="black" />
          </svg>
          <svg class="open" width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 13.3333H20V11.1111H0V13.3333ZM0 7.77778H20V5.55556H0V7.77778ZM0 0V2.22222H20V0H0Z"
              fill="black" />
          </svg>
        </div>
        <div class="content">
          <p>Close menu</p>
        </div>
      </button>
      <?php
    $chat = new Chat($_SESSION['userID']);
    $friends = $chat->getFriends();
    while ($row = $friends->fetch()) {
      echo "<button class='contact' data-toUser='{$row['frID']}' value='{$row['frID']}'>
      <div class='icon'><img class='cpfp' src='../../assets/img/logo.PNG' alt=''></div>
      <div class='content'>{$row['username']}</div>
            </button>";
    }
  ?>
    </div>
    <div class="content">
      <div data-message></div>
      <div class="send-message">
      <input data-message-input type="text" placeholder="type here...">
      <button data-message-button>send</button>
      </div>
    </div>