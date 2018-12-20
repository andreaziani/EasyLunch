<?php
namespace Controller\Action;

use Controller\Controller;
use Controller\InputValidator;

// require and include all the files
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
session_start();
$id = InputValidator::validate($_REQUEST["id"]);
Controller::getInstance()->removeProduct($id);

?>