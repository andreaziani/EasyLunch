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
                //TODO check if not necessary
                //$registeredData["Credit"] = 0;
                //$registeredData["CurrentCartId"] = null;
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
        return $user;
    }

    public function updateProfileInformations($data, $tableName, $username){
        return $this->queryManager->updateInTable($tableName, $data, "UserName", $username);
    }

    public function canReview($user, $orderId) {
        return $this->queryManager->searchByDoubleKey("ReviewableOrders", "ClientId" ,$user->userName, "OrderId", $orderId) != null;
    }

    public function submitReview($orderId, $description, $rank) {
        $data["OrderId"] = $orderId;
        $data["Comment"] = $description;
        $data["Rank"] = $rank;
        return $this->queryManager->insertInTable("ReviewableOrders", $data);
    }

    public function removeCart($user) {
        $data["CurrentCartId"] = null;
        return $this->queryManager->updateInTable("Clients", $data, "Username", $user->userName);
    }
}
