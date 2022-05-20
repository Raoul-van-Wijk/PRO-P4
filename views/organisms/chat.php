<div class="container">
  <div class="contacts">
  <?php
    $chat = new Chat($_SESSION['userID']);
    $friends = $chat->getFriends();
    while ($row = $friends->fetch()) {
      echo "<button class='contact' value='{$row['frID']}'>
            <img class='cpfp' src='../../assets/img/logo.PNG' alt=''>
            {$row['username']}</button>";
    }
  ?>
  
  </div>
  <div id='chat' class="chat">
    <p>Test</p>
  </div>
  <div>
    <input type='text' id='msg-input' value=''>
    <button id='send'>Send</button></div>
</div>
<div id="test"></div>
