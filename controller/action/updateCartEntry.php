<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
    
    if(Controller::getInstance()->updateCartEntry($_GET["id"], $_GET["quantity"])) {
        //echo "Product inserted in the cart.";
    } else {
        echo "Something went wrong, we were unable to register your change to the cart.";
    }
?>