<?php
define("URLROOT", 'http://www.project-p4.gg/index/');

class Config {
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbName = "project-p4";
  protected function connect() {
    $dsn = 'mysql:host='. $this->servername .';dbname='. $this->dbName;
    $pdo = new PDO($dsn, $this->username, $this->password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }
}