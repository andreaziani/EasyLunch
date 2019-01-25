<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Controller\Controller;
use Controller\InputValidator;
use Model\QueryManager;

    if(isset($_POST['username']) && isset($_POST['password'])) { 
        $username = InputValidator::validate($_POST['username']);
        $password = InputValidator::validate($_POST['password']);
        if(isset($_POST['remember'])){
            setcookie("user", $username, time() + (86400 * 30), "/"); //coockie username 1 day
            setcookie("password", $password, time() + (86400 * 30), "/"); //coockie username 1 day
        }
        Controller::getInstance()->login($username, $password);
    } else {
        Controller::getInstance()->actionError();
    }
?>