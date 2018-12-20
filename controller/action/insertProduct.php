<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
use Controller\InputValidator;

session_start();

if (isset($_FILES['image']) && isset($_POST["name"])
    && isset($_POST["description"]) && isset($_POST["price"])) { //check if all the variables are set.
    $provider = InputValidator::validate($_SESSION["username"]);
    $name = InputValidator::validate($_POST['name']);
    $description = InputValidator::validate($_POST['description']);
    $price = InputValidator::validate($_POST['price']);
    $category = InputValidator::validate($_POST['category']);
    $tmp_name = $_FILES['image']['tmp_name'];
    $filename = strtolower($_FILES['image']['name']); //Renaming the file here
    $controller = Controller::getInstance();
    Controller::getInstance()->insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category);
}

?>