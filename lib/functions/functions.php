<?php
function loadPages($page) {
  if(isset($page) && file_exists("./views/templates/{$page}.php")){
    include("./views/templates/{$page}.php");
  }
  if(isset($_GET['lr']) && file_exists("./views/organisms/{$_GET['lr']}.php")){
    include("./views/organisms/{$_GET['lr']}.php");
  }
  if(empty($page) || !file_exists("./views/templates/{$page}.php"))include("./views/templates/home.php");
}



