<div>
  <form class="form" action="" method="POST">
    <input type="text" name="username" placeholder="Username:">
    <input type="password" name="password" placeholder="Password:">
    <?php
    if(isset($_POST['submit'])) {
      $users = new Users();
      $users->loginUsers($_POST['username'], $_POST['password']);
    }
  ?>
    <button type="submit" name="submit">Login</button>
  </form>
</div>