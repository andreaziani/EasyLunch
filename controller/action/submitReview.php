<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;

session_start();

if (isset($_SESSION["user"]) and $_SESSION["user"]->type == "client" and isset($_SESSION["order"]) and 
    isset($_POST['description']) && isset($_POST['rank'])) {
    
    $description = InputValidator::validate($_POST['description']);
    $rank = InputValidator::validate($_POST['rank']);
    Controller::getInstance()->submitReview($description, $rank);
}

?>