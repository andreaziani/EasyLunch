<?php 
    namespace Controller\Action;    
    // require and include all the files
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
    }
    
    use Controller\Controller;
    use Controller\InputValidator;
    if(isset($_GET["key"])){
        $key = InputValidator::validate($_GET["key"]);
        $result = Controller::getInstance()->searchProvider($key);
        $json = json_encode($result);
        echo $json;
    } else {
        Controller::getInstance()->actionError();
    }
?>