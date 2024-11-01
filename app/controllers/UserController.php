<?php
require_once BASE_PATH . '/app/models/User.php';

class UserController {
  private $userModel;

  public function __construct() {
    $this->userModel = new User();
  }

  public function getUser() {
    session_start();

    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($userId) {
      $user = $this->userModel->findUserById($userId);

      if ($user) {
        echo json_encode(['message' => 'User retrieved successfully', 'data' => $user]);
        return;
      }

      http_response_code(404);
      echo json_encode(['message' => 'User not found']);
    } else {
      http_response_code(401);
      echo json_encode(['message' => 'Invalid token']);
    }
  }
}
