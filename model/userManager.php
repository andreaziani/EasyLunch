<?php
namespace Model;
use Model\Data\{Admin, Provider, Client};
use Utils\PathManager;

class UserManager
{
    private $queryManager;
    public function __construct()
    {
        $this->queryManager = new QueryManager();
    }

    public function verifyLogin($username, $password) {
        $user = this->queryManager->searchByKey("Users", "UserName", $username);
        return $user != null and password_verify($password, $user["Password"]);
    }

    public function getUser($username) {
        $user = this->queryManager->searchByKey("Users", "UserName", $username);
        $registeredData = null;
        switch ($userData["Type"]) {
            case "ADMIN":
                $registeredData = new Admin($userData, this->queryManager->searchByKey("Admins", "UserName", $username));
                break;
            case "CLIENT":
                $registeredData = new Client($userData, this->queryManager->searchByKey("Clients", "UserName", $username));
                break;
            case "PROVIDER":
                $registeredData = new Provider($userData, this->queryManager->searchByKey("Providers", "UserName", $username));
                break;
            
        }
        
    }
}
