<?php 
    namespace Controller\Action;    
    // require and include all the files
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
    }
    
    use Controller\Controller;
    use Controller\InputValidator;
    if(isset($_GET["key"]) && isset($_GET["provider"])){
        $key = InputValidator::validate($_GET["key"]);
        $provider = InputValidator::validate($_GET["provider"]);
        $result = Controller::getInstance()->searchProducts($key, $provider);
        $json = json_encode($result);
        echo $json;
    } else {
        Controller::getInstance()->actionError();
    }    
?>