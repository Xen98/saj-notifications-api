<?php
class Database {

  private $host = 'localhost';
  private $user = 'root';
  private $password = "";
  private $database = "saj_notifications";

  public function getConnection() {
    try {
      $conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8mb4", $this->user, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $conn;
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }
}
