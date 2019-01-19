<?php
namespace Controller\Action;

use Controller\Controller;
use Controller\InputValidator;

// require and include all the files
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

session_start();

if (isset($_GET["name"]) && isset($_GET["description"]) && isset($_GET["price"])) {
    $name = InputValidator::validate($_GET["name"]);
    $description = InputValidator::validate($_GET["description"]);
    $price = floatval(InputValidator::validate($_GET["price"]));
    $id = intval(InputValidator::validate($_GET["id"]));
    Controller::getInstance()->modifyProduct($name, $description, $price, $id);
} else {
    Controller::getInstance()->actionError();
}

?>