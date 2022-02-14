<?php

class Dbh {
  private $host = "localhost";
  private $user = "root";
  private $pwd = "123!@#";
  private $dbName = "tribunal";
  private $conn;

  public function connect(){
    $this->conn = null;
    try {
      $dsn = 'mysql:host=' . $this->host . ';dbname='. $this->dbName;
      $this->conn = new PDO($dsn, $this->user, $this->pwd);
      //echo 'Database connection successful';
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->conn;
    } 
    catch(PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
  }

}

?>

