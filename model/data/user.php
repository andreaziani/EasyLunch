<?php
namespace Model\Data;
    class User {
        private $userName;

        protected function __construct($userData) {
            $this->userName = $userData["UserName"];
        }
    }
?>