<?php 
namespace Controller\Action;

use Controller\Controller;
    
    session_start();

    $controller = Controller::getInstance();

    if(isset($_FILES['image']) && isset($_POST["name"]) 
        && isset($_POST["description"]) && isset($_POST["price"])) { //check if all the variables are set.
        $provider = $_SESSION["username"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = strtolower($_FILES['image']['name']); //Renaming the file here
        $controller->insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category);
    }

    header("location: ../../view/template/providerproductslist/providerProductsList.php");
?>