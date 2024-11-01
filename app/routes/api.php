<?php
$routes = [
  [
    'method' => 'POST',
    'uri' => 'login',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/AuthController.php';

      $authController = new AuthController();
      $authController->login();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'user',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/UserController.php';
      $userController = new UserController();
      $userController->getUser();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'companies',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/CompanyController.php';
      $companyController = new CompanyController();
      $companyController->getCompanies();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'countries',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/CountryController.php';
      $countryController = new CountryController();
      $countryController->getCountries();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'systems',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/SystemController.php';
      $systemController = new SystemController();
      $systemController->getSystems();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'notifications',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/NotificationController.php';
      $notificationController = new NotificationController();
      $notificationController->getNotifications();
    }
  ],
  [
    'method' => 'POST',
    'uri' => 'notification',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/NotificationController.php';
      $notificationController = new NotificationController();
      $notificationController->createNotification();
    }
  ],
  [
    'method' => 'GET',
    'uri' => 'notification',
    'callback' => function ($id = null) {
      require_once BASE_PATH . '/app/controllers/NotificationController.php';
      $notificationController = new NotificationController();
      $notificationController->findNotificationById($id);
    }
  ],
  [
    'method' => 'PUT',
    'uri' => 'notification',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/NotificationController.php';
      $notificationController = new NotificationController();
      $notificationController->updateNotification();
    }
  ],
  [
    'method' => 'DELETE',
    'uri' => 'notification',
    'callback' => function () {
      require_once BASE_PATH . '/app/controllers/NotificationController.php';
      $notificationController = new NotificationController();
      $notificationController->deleteNotification();
    }
  ],
];
