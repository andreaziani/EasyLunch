<?php
namespace ProgettoTecWeb\Model\Data;
    class User {
        private $userName;

        protected function __construct($userData) {
            $this->userName = $userData["UserName"];
        }
    }

    class Admin extends User {
        private $creditPerProduct;

        public function __construct($userData, $adminData) {
            parent::__construct($userData);
            $this->creditPerProduct = $adminData["CreditPerProduct"];
        }
    }

    abstract class RegisteredUser extends User {
        private $name;
        private $surname;
        private $birthdate;
        private $phoneNumber;
        private $email;
        protected function __construct($userData, $registeredData) {
            parent::__construct($userData);
            $this->name = $registeredData["Name"];
            $this->surname = $registeredData["Surname"];
            $this->birthdate = $registeredData"Birthdate"];
            $this->phoneNumber = $registeredData["PhoneNumber"];
            $this->email = $registeredData["Email"];
        }
    }

    class Provider extends RegisteredUser {
        private $address;
        private $iva;
        public function __construct($userData, $registeredData) {
            parent::__construct($userData, $registeredData);
            $this->address = $registeredData["Address"];
            $this->iva = $registeredData["IVA"];
        }
    }

    class Client extends RegisteredUser {
        private $credit;
        public function __construct($userData, $registeredData) {
            parent::__construct($userData, $registeredData);
            $this->credit = $registeredData["Credit"];
        }
    }
?>