<?php
  function sanitize($raw_data) {
    $data = htmlspecialchars($raw_data);
    $data = trim($data);
    return $data;
  }