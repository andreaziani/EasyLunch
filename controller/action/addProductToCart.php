<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;

    $data = array();
    $data["ProductId"] = $_GET["id"];
    $data["ProductName"] = $_GET["name"];
    $data["Price"] = $_GET["price"];
    $data["Quantity"] = round($_GET["quantity"], 0);
    
    if(Controller::getInstance()->addProductToCart($data)){
        echo "Product insert in the cart.";
    } else{
        echo "Something's wrong with the inseriment in the cart.";
    }
?>