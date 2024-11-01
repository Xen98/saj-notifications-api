<?php
require_once BASE_PATH . '/config/Database.php';

class System {
  private $conn;

  public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function getSystems() {
    $sql = "SELECT * FROM systems";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findSystemById($id) {
    $sql = "SELECT * FROM systems WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
