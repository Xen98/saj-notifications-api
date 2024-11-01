<?php
// // Generación del hash
// $password = 'admin';
// $hash = password_hash($password, PASSWORD_DEFAULT);
// echo "Hash: $hash\n";

// // Verificación del hash
// $inputPassword = 'admin'; // Prueba con la contraseña correcta
// if (password_verify($inputPassword, '$2y$10$okshVvy2UjcoYW4PozMA3uZDXqGS/d2qFLGZCi1zb8DRcYkWCwDCS')) {
//   echo "La contraseña es válida.\n";
// } else {
//   echo "La contraseña es inválida.\n";
// }

// // Prueba con una contraseña incorrecta
// $wrongPassword = 'contraseñaIncorrecta';
// if (password_verify($wrongPassword, '$2y$10$okshVvy2UjcoYW4PozMA3uZDXqGS/d2qFLGZCi1zb8DRcYkWCwDC2')) {
//   echo "La contraseña es válida.\n";
// } else {
//   echo "La contraseña es inválida.\n";
// }

$route = [
  'uri' => 'login'
];

$requestUri = "saj_notifications_back/login";

$res = preg_match(
  '#^' . preg_replace('/{[^}]+}/', '([^/]+)', $route['uri']) . '$#',
  $requestUri,
  $matches
);

var_dump($res);
