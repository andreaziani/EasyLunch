<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
use Controller\InputValidator;
    session_start();

    if (isset($_SESSION["user"]) && isset($_POST["name"])){
        Controller::getInstance()->insertCategory($_POST["name"]);
    } else {
        Controller::getInstance()->actionError();
    }

?>