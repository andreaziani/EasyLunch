<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Controller\Controller;
use Controller\InputValidator;
use Model\QueryManager;
    
    if(isset($_POST['name']) && isset($_POST['companyName']) && isset($_POST['surname']) &&
       isset($_POST['username']) && isset($_POST['password']) && 
       isset($_POST['telephone']) && isset($_POST['rpassword']) && 
       $_POST['password'] === $_POST['rpassword'] &&
       isset($_POST['birthdate']) && isset($_POST['email']) && 
       isset($_POST['typology']) && ($_POST["typology"] === "client" || 
            ($_POST["typology"] === "provider" && isset($_POST["cityAddress"]) && 
            isset($_POST["addressStreet"]) && isset($_POST["addressNumber"]) && isset($_POST["piva"])))) {

        $userData["username"] = InputValidator::validate($_POST['username']);
        $userData["password"] = password_hash(InputValidator::validate($_POST['password']), PASSWORD_DEFAULT);
        $userData["rpassword"] = password_hash(InputValidator::validate($_POST['rpassword']), PASSWORD_DEFAULT);
        $userData["name"] = InputValidator::validate($_POST['name']);
        $userData["companyName"] = InputValidator::validate($_POST['companyName']);
        $userData["surname"] = InputValidator::validate($_POST['surname']);
        $userData["telephone"] = InputValidator::validate($_POST['telephone']);
        $userData["birthdate"] = InputValidator::validate($_POST['birthdate']);
        $userData["email"] = InputValidator::validate($_POST['email']);
        $userData["type"] = InputValidator::validate($_POST['typology']);
        $userData["piva"] = null;
        if ($userData["type"] === "provider") {
            $userData["piva"] = InputValidator::validate($_POST["piva"]);
            $userData["cityAddress"] = InputValidator::validate($_POST["cityAddress"]);
            $userData["addressStreet"] = InputValidator::validate($_POST["addressStreet"]);
            $userData["addressNumber"] = InputValidator::validate($_POST["addressNumber"]);
        }
        Controller::getInstance()->register($userData);
    } else {
        Controller::getInstance()->actionError();
    }
?>