<?php
require_once BASE_PATH . '/app/models/Notification.php';

class NotificationController {
  private $notificationModel;
  private $allowedTypes = ['Informativo', 'Error', 'Éxito', 'Precaución/Advertencia'];

  public function __construct() {
    $this->notificationModel = new Notification();
  }

  public function createNotification() {
    $data = json_decode(file_get_contents("php://input"), true);

    $message = $data['message'] ?? '';
    $company_id = $data['company_id'] ?? '';
    $country_id = $data['country_id'] ?? '';
    $system_id = $data['system_id'] ?? '';
    $duration = $data['duration'] ?? '';
    $type = $data['type'] ?? '';
    $color = $data['color'] ?? '';

    if (empty($message) || empty($company_id) || empty($country_id) || empty($system_id) || empty($duration) || empty($type) || empty($color)) {
      http_response_code(400);
      echo json_encode(['message' => 'Missing required fields']);
      return;
    }

    if (!$this->validateNotificationType($type)) {
      http_response_code(400);
      echo json_encode(['message' => 'Invalid notification type']);
      return;
    }

    $result = $this->notificationModel->createNotification($message, $company_id, $country_id, $system_id, $duration, $type, $color);

    if ($result) {
      http_response_code(201);
      echo json_encode(['message' => 'Notification created successfully']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Failed to create notification']);
    }
  }

  public function getNotifications() {
    $result = $this->notificationModel->getNotifications();

    echo json_encode(['message' => 'Notifications retrieved successfully', 'data' => $result]);
    return;
  }

  public function findNotificationById($id) {
    if (empty($id)) {
      http_response_code(400);
      echo json_encode(['message' => 'Missing notification id']);
      return;
    }

    $result = $this->notificationModel->findNotificationById($id);

    if ($result) {
      echo json_encode(['message' => 'Notification retrieved successfully', 'data' => $result]);
    } else {
      http_response_code(404);
      echo json_encode(['message' => 'Notification not found']);
    }
  }

  public function updateNotification() {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'] ?? '';
    $message = $data['message'] ?? '';
    $company_id = $data['company_id'] ?? '';
    $country_id = $data['country_id'] ?? '';
    $system_id = $data['system_id'] ?? '';
    $duration = $data['duration'] ?? '';
    $type = $data['type'] ?? '';
    $color = $data['color'] ?? '';

    if (empty($id) || empty($message) || empty($company_id) || empty($country_id) || empty($system_id) || empty($duration) || empty($type) || empty($color)) {
      http_response_code(400);
      echo json_encode(['message' => 'Missing required fields']);
      return;
    }

    if (!$this->validateNotificationType($type)) {
      http_response_code(400);
      echo json_encode(['message' => 'Invalid notification type']);
      return;
    }

    $result = $this->notificationModel->updateNotification($id, $message, $company_id, $country_id, $system_id, $duration, $type, $color);

    if ($result) {
      http_response_code(200);
      echo json_encode(['message' => 'Notification updated successfully']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Failed to update notification']);
    }
  }

  public function deleteNotification() {
    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'] ?? '';

    if (empty($id)) {
      http_response_code(400);
      echo json_encode(['message' => 'Missing notification id']);
      return;
    }

    $result = $this->notificationModel->deleteNotification($id);

    if ($result) {
      http_response_code(200);
      echo json_encode(['message' => 'Notification deleted successfully']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Failed to delete notification']);
    }
  }

  private function validateNotificationType($type) {
    return in_array($type, $this->allowedTypes);
  }
}
