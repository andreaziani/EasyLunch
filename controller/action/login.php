<?php
use ProgettoTecWeb\Controller\Controller;
use ProgettoTecWeb\Controller\InputValidator;

    if(isset($_POST['username']) && isset($_POST['password'])) { 
        $manager = new QueryManager();
        $username = InputValidator::validate($_POST['username']);
        $password = InputValidator::validate($_POST['password']);
        Controller::getInstance().login($username, $password);
    }
?>