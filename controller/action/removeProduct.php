<?php
namespace Controller\Action;

use Controller\Controller;

    session_start();
    $provider = InputValidator::validate($_SESSION["username"]);
    $name = InputValidator::validate($_REQUEST["name"]);
    Controller::getInstance()->removeProduct($name, $provider);
?>