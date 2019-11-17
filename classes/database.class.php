<?php

class Database{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "bruhbookDB";

  protected function connect(){
    $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    return $conn;
  }
}
