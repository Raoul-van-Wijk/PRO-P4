<div>
  <form class="form" action="" method="POST">
    <input type="text" name="username" placeholder="Username:">
    <input type="password" name="password" placeholder="Password:">
    <?php
    if(isset($_POST['submit-l'])) {
      $users = new Users();
      echo $users->loginUsers($_POST['username'], $_POST['password']);
    }
  ?>
    <button type="submit" name="submit-l">Login</button>
  </form>
</div>