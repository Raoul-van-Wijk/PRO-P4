<form class="form" action="" method="POST">
  <input type="text" name="username">
  <input type="password" name="password">
  <input type="file" name="profilePicture" placeholder="Profile Picture">
  <textarea name="Bio" placeholder="Bio" id="" cols="30" rows="10"></textarea>
  <input type="text" name="age" placeholder="Age">
  <button type="submit" name="submit">Register</button>
</form>
<?php
  if(isset($_POST['submit'])) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $bio = sanitize($_POST['Bio']);
    $age = sanitize($_POST['age']);
    $users = new Users();
    $users->registerNewUser($username, $password, $_POST['profilePicture'], $bio, $age);
  }
?>