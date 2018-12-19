<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Controller\Controller;
use Controller\InputValidator;
use Model\QueryManager;

    if(isset($_POST['username']) && isset($_POST['password'])) { 
        $manager = new QueryManager();
        $username = InputValidator::validate($_POST['username']);
        $password = InputValidator::validate($_POST['password']);
        Controller::getInstance()->login($username, $password);
    }
?>