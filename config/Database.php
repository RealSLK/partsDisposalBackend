<?php 
  class Database {
    // DB Params
    private $host = 'partscollectiondb.c3so2xarqjh9.us-east-1.rds.amazonaws.com'; // localhost
    private $db_name = 'partsdisposaldb';
    private $username = 'root';
    private $password = 'Waidler123'; // @Waidler2018
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
  ?>