<?php
require_once BASE_PATH . '/config/Database.php';

class Notification {
  private $conn;

  public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function createNotification($message, $company_id, $country_id, $system_id, $duration, $type, $color) {
    $sql = "INSERT INTO notifications (
      message, company_id, country_id, system_id, duration, type, color, status
    ) VALUES (
      :message, :company_id, :country_id, :system_id, :duration, :type, :color, 'A'
    )";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':company_id', $company_id);
    $stmt->bindParam(':country_id', $country_id);
    $stmt->bindParam(':system_id', $system_id);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':color', $color);

    return $stmt->execute();
  }

  public function getNotifications() {
    $sql = "SELECT * FROM notifications WHERE status = 'A'";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findNotificationById($id) {
    $sql = "SELECT * FROM notifications WHERE id = :id AND status = 'A'";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updateNotification($id, $message, $company_id, $country_id, $system_id, $duration, $type, $color) {
    $sql = "UPDATE notifications SET
      message = :message, company_id = :company_id, country_id = :country_id, system_id = :system_id, duration = :duration, type = :type, color = :color
      WHERE id = :id
    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':company_id', $company_id);
    $stmt->bindParam(':country_id', $country_id);
    $stmt->bindParam(':system_id', $system_id);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':color', $color);

    return $stmt->execute();
  }

  public function deleteNotification($id) {
    $sql = "UPDATE notifications SET status = 'B' WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
  }
}
