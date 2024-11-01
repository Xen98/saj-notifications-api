<?php
require_once BASE_PATH . '/app/models/User.php';

use Firebase\JWT\JWT;

class AuthController {
  private $userModel;

  public function __construct() {
    $this->userModel = new User();
  }

  public function login() {
    $data = json_decode(file_get_contents("php://input"), true);

    $username = $data['user'] ?? '';
    $password = $data['password'] ?? '';

    $user = $this->userModel->findUserByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
      $token = $this->generateJWT($user['id']);
      echo json_encode(['token' => $token]);
    } else {
      http_response_code(401);
      echo json_encode(['message' => 'Invalid credentials']);
    }
  }

  private function generateJWT($userId) {
    $payload = [
      'iat' => time(),
      'exp' => time() + 3600, // Expira en 1 hora
      'id' => $userId
    ];

    return JWT::encode($payload, JWT_SECRET, 'HS256');
  }
}
