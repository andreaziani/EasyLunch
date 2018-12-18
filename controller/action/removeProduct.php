<?php
namespace Controller\Action;

use Controller\Controller;
    
    session_start();
    $controller = Controller::getInstance();

    $provider = $_SESSION["username"];
    $name = $_REQUEST["name"];
    $controller->removeProduct($name, $provider);

    header("location: ../../view/template/providerproductlist/providerProductsList.php");
?>