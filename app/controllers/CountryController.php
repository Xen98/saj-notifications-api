<?php
require_once BASE_PATH . '/app/models/Country.php';

class CountryController {
  private $countryModel;

  public function __construct() {
    $this->countryModel = new Country();
  }

  public function getCountries() {
    $result = $this->countryModel->getCountries();

    echo json_encode(['message' => 'Countries retrieved successfully', 'data' => $result]);
    return;
  }
}
