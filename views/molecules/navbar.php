<?php 
  if (isset($_GET['logout'])) {
    if($_GET['logout'] == true) {
      $logout = new Users;
      $logout->logoutUser();
    }
  }
?>

<nav>
  
  <img src="../../assets/img/logo.PNG">

  <ul>
    <li><a href="<?php echo URLROOT;?>page/main/home">home</a></li>
    <li><a href="<?php echo URLROOT;?>page/main/chat">Chat</a></li> 
    <li><div id="dropdownTag" data-userid="<?php echo $_SESSION['userID']?>"><?php echo $_SESSION['username']?> 
      <div id="dropdownMenu">
        <a href="">my profile</a>
        <?php 
          if($_SESSION['userrole'] == 'admin' || $_SESSION['userrole'] ==  'root') {
            echo '<a href="'.  URLROOT . 'page/main/adminDashboard">admin dashboard</a>';
          }
        ?>
        <a href="&logout=true">logout</a>
      </div>
    </div></li>
  </ul>
</nav>