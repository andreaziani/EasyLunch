<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Controller\Controller;
use Controller\InputValidator;
session_start();

if (isset($_SESSION["user"]) and isset ($_SESSION["cart"])
    and isset($_POST["nominative"]) and isset($_POST["deliverySpot"]) 
    and isset($_POST["deliveryDate"]) and isset($_POST["deliveryTime"])) {
        $nominative = InputValidator::validate($_POST["nominative"]);
        $spot = InputValidator::validate($_POST["deliverySpot"]);
        //var_dump($spot);
        $d = InputValidator::validate($_POST["deliveryDate"]);
        $t = InputValidator::validate($_POST["deliveryTime"]);
        //var_dump($d);
        //var_dump($t);
        $timestamp = strtotime(date($d . "T" . $t));
        //var_dump(date($d . "T" . $t));
        //var_dump($timestamp);
        $dateTime = date('Y-m-d G:i:s', $timestamp);
        //var_dump($dateTime);
        Controller::getInstance()->checkoutOrder($nominative, $spot, $dateTime);
}

?>