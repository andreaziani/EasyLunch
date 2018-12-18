<?php
use Controller\Controller;
use Controller\InputValidator;

    if(isset($_POST['username']) && isset($_POST['password'])) { 
        $username = InputValidator::validate($_POST['username']);
        $password = InputValidator::validate($_POST['password']);
        Controller::getInstance().login($username, $password);
    }
?>