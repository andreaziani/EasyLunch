<?php
namespace Controller\Action;

use Controller\Controller;

    session_start();
    $view = View::getInstance();
    $provider = $_SESSION["username"];
    $name = $_REQUEST["name"];
    Controller::getInstance()->removeProduct($name, $provider);
?>