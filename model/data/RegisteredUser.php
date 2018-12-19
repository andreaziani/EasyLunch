<?php
namespace Model\Data;
use Model\Data\User;
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
            $this->birthdate = $registeredData["Birthdate"];
            $this->phoneNumber = $registeredData["PhoneNumber"];
            $this->email = $registeredData["Email"];
        }
    }
?>