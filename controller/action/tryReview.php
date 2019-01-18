<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
use Controller\InputValidator;

session_start();
if (isset($_SESSION["user"]) and $_SESSION["user"]->type == "CLIENT" and isset($_GET['orderId'])) {
    Controller::getInstance()->tryReview(InputValidator::validate($_GET['orderId']));
}

?>