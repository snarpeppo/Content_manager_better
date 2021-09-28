<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config.php';

class db_connection
{
  private $dbName, $host, $username, $password, $link;

  public function __construct($connString = DB_CONN, $username = DB_USER, $password = DB_PASS)
  {
    $this->connString = $connString;
    $this->username = $username;
    $this->password = $password;
    $this->connect();
  }

  public function connect()
  {
    try {

      $this->link = new PDO($this->connString, $this->username, $this->password);
    } catch (Exception $e) {
      if (DEBUG) {
        echo $e;
      }
      return false;
    }
  }

  public function fetchAll($queryString, $binderObj = [])
  {
    $s = $this->link->prepare($queryString);
    foreach ($binderObj as $key => $v) {
      if (!is_array($v)) {
        $v = [
          "val" => $v,
          "type" => PDO::PARAM_STR,
        ];
      }
      $s->bindParam($key, $v["val"], $v["type"]);
    }
    if ($s->execute()) {
      $r = $s->fetchAll(PDO::FETCH_ASSOC);  // fetchAll() ----> Returns an array(indici interi) of array(obj tipo js) containing all of the result set rows
      return $r;
    } else {
      echo "db error: " . implode(' - ', $s->errorInfo());
    }
  }

  public function UpdateOrDelete($queryString, $binderObj = [])
  {
    $s = $this->link->prepare($queryString);
    foreach ($binderObj as $key => $v) {
      if (!is_array($v)) {
        $v = [
          "val" => $v,
          "type" => PDO::PARAM_STR,
        ];
      }
      $s->bindParam($key, $v["val"], $v["type"]);
    }
    if ($s->execute() && $s->rowCount() > 0) {
      return true;
    } else {
      return "db error: " . implode(' - ', $s->errorInfo());
    }
  }
} //end of class
