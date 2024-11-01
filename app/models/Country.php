<?php
require_once BASE_PATH . '/config/Database.php';

class Country {
  private $conn;

  public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function getCountries() {
    $sql = "SELECT * FROM countries";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findCountryById($id) {
    $sql = "SELECT * FROM countries WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
