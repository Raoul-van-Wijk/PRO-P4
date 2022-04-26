<?php
  // include_once('classes/config.php');
  // include_once('functions/functions.php');
  // include_once('classes/Users.php');
  // include_once('classes/Post.php');

function autoLoadFiles($folder) {
  foreach(glob("lib/{$folder}/*.php") as $file) {
    include $file;
  }
}

autoLoadFiles('classes');
autoLoadFiles('functions');