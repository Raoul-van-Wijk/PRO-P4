<form class="form" action="" method="POST">
  <input type="text" name="username">
  <input type="password" name="password">
  <button type="submit" name="submit">Register</button>
</form>
<?php
  if(isset($_POST['submit'])) {
    $users = new Users();
    $users>-registerNewUser($_POST['username'], $_POST['password']);
  }
?>