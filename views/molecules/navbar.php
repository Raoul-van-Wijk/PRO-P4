<nav>
  <ul>
    <li><a href="<?php echo URLROOT;?>page/main/home">home</a></li>
    <li><a href="<?php echo URLROOT;?>page/main/chat">Chat</a></li>

    <?php
    if(isset($_SESSION['userID'])) {
      echo '<li><a href="index.php?logout=true">Logout</a></li>';
    } else {
      echo "    
        <li><a href='".URLROOT."page/lr/login'>login</a></li>
        <li><a href='".URLROOT."page/lr/register'>Register</a></li>";
    }
    ?>
  </ul>
</nav>
<?php
  if(isset($_GET['logout'])) {
    $logout = new Users;
    $logout->logoutUser();
  }
?>