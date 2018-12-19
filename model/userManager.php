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
        $user = $this->queryManager->searchByKey("Users", "UserName", $username);
        return $user != null and password_verify($password, $user["Password"]);
    }

    public function getUser($username) {
        $userData = $this->queryManager->searchByKey("Users", "UserName", $username);
        $user = null;
        switch ($userData["Type"]) {
            case "ADMIN":
                $user = new Admin($userData, $this->queryManager->searchByKey("Admins", "UserName", $username));
                break;
            case "CLIENT":
                $user = new Client($userData, $this->queryManager->searchByKey("Clients", "UserName", $username));
                break;
            case "PROVIDER":
                $user = new Provider($userData, $this->queryManager->searchByKey("Providers", "UserName", $username));
                break;
        }
        return $user;
    }
}
