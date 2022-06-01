<form class="form" action="" method="POST">
  <input type="text" name="username">
  <input type="password" name="password">
  <input type="text" name="age" placeholder="Age">
  <button type="submit" name="submit-r">Register</button>
</form>
<?php
  if(isset($_POST['submit-r'])) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $age = sanitize($_POST['age']);
    $users = new Users();
    $users->registerNewUser($username, $password, $age);
  }
?>