<?php
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

    $id = $_GET["id"];
    $name = $_GET["name"];
    $price = $_GET["price"];
    $quantity = $_GET["quantity"];

    echo $id . " " . $name . " " . $price . " " . $quantity;
?>