<?php
  session_start(); session_gc();
  require('lib/index.php');
  if(empty($_GET['page'])) {$_GET['page'] = 'home';}
  if(!empty($_GET['page'])) {$page = $_GET['page'];}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project-p4</title>
  <link rel="stylesheet" href="/page/../../assets/styles/css/style.css">
</head>
<body>
  <header><?php require_once('./views/organisms/navbar.php'); ?></header>
    <main>
      <?php 
      loadPages($page); ?>
    </main>
  <footer><?php require_once('./views/organisms/footer.php'); ?></footer>
</body>
</html>
