<?php
  session_start(); session_gc();
  require_once('lib/index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project-p4</title>
  <link rel="stylesheet" href="<?php echo URLROOT ?>assets/styles/css/style.css">
  <!-- link javascript -->
  <script defer src="<?php echo URLROOT ?>assets/js/app.js"></script>
  <script defer src="<?php echo URLROOT ?>assets/js/ajax.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="<?= URLROOT ?>views/atoms/test.css">
</head>
<body class="<?php echo checkPage('index') ?>">
  <?php loadTemplate(); ?>
</body>
</html>
