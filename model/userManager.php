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

    public function canRegister($userData) {
        return $this->queryManager->searchByKey("Users", "UserName", $userData["username"]) === null;
    }

    public function register($userData) {
        $simpleData["UserName"] = $userData["username"];
        $simpleData["Password"] = $userData["password"];
        $simpleData["Type"] = $userData["Type"];
        if($this->queryManager->insertInTable("Users", $simpleData)) {
            $registeredData["UserName"] = $userData["username"];
            $registeredData["Name"] = $userData["name"];
            $registeredData["Surname"] = $userData["Surname"];
            $registeredData["Birthdate"] = $userData["BirthDate"];
            $registeredData["PhoneNumber"] = $userData["telephone"];
            $registeredData["Email"] = $userData["email"];
            if ($simpleData["Type"] === "Client") {
                $table = "Clients";
                $registeredData["Credit"] = 0;
            } else {
                $table = "Providers";
                $registeredData["Address"] = $userData["address"];
                $registeredData["IVA"] = $userData["piva"];
            }
            if ($this->queryManager->insertInTable($table, $simpleData)) {
                return getUser($simpleData["username"]);
            }
        }
        return null;
    }

    public function verifyLogin($username, $password) {
        $user = $this->queryManager->searchByKey("Users", "UserName", $username);
        echo password_hash("admin", PASSWORD_DEFAULT);
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
