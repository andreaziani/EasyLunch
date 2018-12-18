<?php
namespace Controller\Action;

use Controller\Controller;

    session_start();
    
    if(isset($_GET["name"]) && isset($_GET["description"]) && isset($_GET["price"])){
        $provider = $_SESSION["username"];
        $name = $_GET["name"];
        $description = $_GET["description"];
        $price = $_GET["price"];

        Controller::getInstance()->modifyProduct($name, $description, $price, $provider);
    }  
?>
