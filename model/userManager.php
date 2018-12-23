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
        $simpleData["Type"] = $userData["type"];
        if($this->queryManager->insertInTable("Users", $simpleData)) {
            $registeredData["UserName"] = $userData["username"];
            $registeredData["Name"] = $userData["name"];
            $registeredData["Surname"] = $userData["surname"];
            $registeredData["BirthDate"] = $userData["birthdate"];
            $registeredData["PhoneNumber"] = $userData["telephone"];
            $registeredData["Email"] = $userData["email"];
            if ($simpleData["Type"] === "client") {
                $table = "Clients";
                $registeredData["Credit"] = 0;
            } else {
                $table = "Providers";
                $registeredData["CompanyName"] = $userData["companyName"];
                $registeredData["CityAddress"] = $userData["cityAddress"];
                $registeredData["AddressStreet"] = $userData["addressStreet"];
                $registeredData["AddressNumber"] = $userData["addressNumber"];
                $registeredData["IVA"] = $userData["piva"];
            }
            return $this->queryManager->insertInTable($table, $registeredData);
        }
        return false;
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
        $user->userName = $userData["Username"];
        return $user;
    }

    public function updateProfileInformations($data, $tableName){
        return $this->queryManager->updateInTable($tableName, $data);
    }
}
