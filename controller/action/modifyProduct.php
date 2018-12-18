<?php
include ("../controller.php");

    session_start();
    $controller = Controller::getInstance();
    if(isset($_GET["name"]) && isset($_GET["description"]) && isset($_GET["price"])){
        $provider = $_SESSION["username"];
        $name = $_GET["name"];
        $description = $_GET["description"];
        $price = $_GET["price"];

        $controller->modifyProduct($name, $description, $price, $provider);
    }
    header("location: ../../view/template/providerproductslist/providerProductsList.php");
?>
