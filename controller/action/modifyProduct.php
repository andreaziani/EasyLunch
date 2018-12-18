<?php
namespace Controller\Action;

use Controller\Controller;
use Controller\InputValidator;
    session_start();
    
    if(isset($_GET["name"]) && isset($_GET["description"]) && isset($_GET["price"])){
        $provider = InputValidator::validate($_SESSION["username"]);
        $name = InputValidator::validate($_GET["name"]);
        $description = InputValidator::validate($_GET["description"]);
        $price = InputValidator::validate($_GET["price"]);

        Controller::getInstance()->modifyProduct($name, $description, $price, $provider);
    }  
?>
