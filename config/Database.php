<?php 
  class Database {
    // DB Params
    private $host = 'localhost'; //partscollectiondb.c3so2xarqjh9.us-east-1.rds.amazonaws.com
    private $db_name = 'partsdisposaldb';
    private $username = 'root';
    private $password = '@Waidler2018'; //Waidler123
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