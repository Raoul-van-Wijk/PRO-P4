<nav>
  <ul>
    <li><a href="<?php echo URLROOT;?>index/page/home">home</a></li>

    <?php
    if(isset($_SESSION['userID'])) {
      echo '<li><a href="index.php?logout=true">Logout</a></li>';
    } else {
      $url = $_GET['page'];
      echo "    
        <li><a href='?lr=login'>login</a></li>
        <li><a href='?lr=register'>Register</a></li>";
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