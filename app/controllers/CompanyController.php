<?php
require_once BASE_PATH . '/app/models/Company.php';

class CompanyController {
  private $companyModel;

  public function __construct() {
    $this->companyModel = new Company();
  }

  public function getCompanies() {
    $result = $this->companyModel->getCompanies();

    echo json_encode(['message' => 'Companies retrieved successfully', 'data' => $result]);
    return;
  }
}
