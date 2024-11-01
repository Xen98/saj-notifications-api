<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header("HTTP/1.1 200 OK");
  exit();
}

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/routes/api.php';

require_once __DIR__ . '/app/middlewares/AuthMiddleware.php';

if (!defined('JWT_SECRET')) {
  die('Error: JWT_SECRET not defined.');
}

$publicRoutes = [
  'login' => 'POST'
];

$authMiddleware = new AuthMiddleware();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0];

$url_parts = explode('/', trim($requestUri, '/'));
$endpoint = array_pop($url_parts);

foreach ($routes as $route) {
  if ($requestMethod !== $route['method']) {
    continue;
  }

  if ($endpoint !== $route['uri']) {
    continue;
  }

  // Validar si el usuario necesita autenticación, en caso de que lo necesite se ejecuta la validación de autenticación
  if (!isset($publicRoutes[$endpoint]) || $publicRoutes[$endpoint] !== $requestMethod) {
    $authMiddleware->handle();
  }

  $params = [];

  if (isset($_GET) && !empty($_GET)) {
    $params = $_GET;
  }

  // Se ejecuta la función correspondiente a la ruta encontrada
  call_user_func_array($route['callback'], $params);
  exit;
}

http_response_code(404);
echo json_encode(['message' => 'Not Found']);
