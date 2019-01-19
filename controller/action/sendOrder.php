<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
use Controller\InputValidator;

session_start();

if (isset($_SESSION["user"]) and $_SESSION["user"]->type == "PROVIDER" and 
    isset($_SESSION["order"]) and isset($_POST['minutes'])) {
    
    $minutes = InputValidator::validate($_POST['minutes']);
    Controller::getInstance()->sendOrder($_SESSION["order"], $minutes);
} else {
    Controller::getInstance()->actionError();
}

?>