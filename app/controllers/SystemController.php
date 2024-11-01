<?php
require_once BASE_PATH . '/app/models/System.php';

class SystemController {
  private $systemModel;

  public function __construct() {
    $this->systemModel = new System();
  }

  public function getSystems() {
    $result = $this->systemModel->getSystems();

    echo json_encode(['message' => 'Systems retrieved successfully', 'data' => $result]);
    return;
  }
}
