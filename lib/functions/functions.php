<?php
function loadTemplate() {
  $page = $_GET['page'];
  if(isset($page)) {
    $url = explode("/", $page);
    if(file_exists("./views/templates/{$url[0]}.php")) {
      include("./views/templates/{$url[0]}.php");
    } else {
      include("./views/templates/lr.php");
    }
  }
}

function loadContent() {
  $page = $_GET['page'];
  if(isset($page)) {
    $url = explode("/", $page);
    if(file_exists("./views/organisms/{$url[1]}.php")) {
      include("./views/organisms/{$url[1]}.php");
    }
  }
}



