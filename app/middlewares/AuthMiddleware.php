<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
  public function handle() {
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
      $authHeader = $headers['Authorization'];
      $jwt = sscanf($authHeader, 'Bearer %s')[0];

      if ($jwt) {
        try {
          $decoded = JWT::decode($jwt, new Key(JWT_SECRET, 'HS256'));

          $_SESSION['user_id'] = $decoded->id;

          return $decoded;
        } catch (Exception $e) {
          http_response_code(401);
          echo json_encode(['message' => 'Token inválido: ' . $e->getMessage()]);
          exit;
        }
      }
    }

    http_response_code(401);
    echo json_encode(['message' => 'Need authorization']);
    exit;
  }
}
