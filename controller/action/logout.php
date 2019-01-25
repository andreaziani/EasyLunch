<?php 
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Controller\Controller;
    setcookie('user', '', -time() + (86400 * 30), "/");
    setcookie('password', '', -time() + (86400 * 30), "/");
    Controller::getInstance()->logout();   
?>