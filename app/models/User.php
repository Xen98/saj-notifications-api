<?php
require_once BASE_PATH . '/config/Database.php';

class User {
  private $conn;

  public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function findUserById($id) {
    $sql = "SELECT id, user, name FROM users WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findUserByUsername($username) {
    $sql = "SELECT * FROM users WHERE user = :username";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':username', $username);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
