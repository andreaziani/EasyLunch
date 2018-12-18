<?php
namespace Controller\Action;

use Controller\Controller;

    session_start();
    $controller = Controller::getInstance();
    $view = View::getInstance();
    $provider = $_SESSION["username"];
    $name = $_REQUEST["name"];
    $controller->removeProduct($name, $provider);
?>