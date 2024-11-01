<?php
require_once BASE_PATH . '/config/Database.php';

class Company {
  private $conn;

  public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function getCompanies() {
    $sql = "SELECT * FROM companies";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findCompanyById($id) {
    $sql = "SELECT * FROM companies WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
