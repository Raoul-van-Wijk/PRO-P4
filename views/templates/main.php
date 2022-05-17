<?php
  if(!isset($_SESSION['userID'])) {
    header("location: ". URLROOT ."page/lr");
  }
?>

<header><?php require_once('./views/molecules/navbar.php'); ?></header>
  <main>
    <?php loadContent() ?>
  </main>
<footer><?php require_once('./views/molecules/footer.php'); ?></footer>