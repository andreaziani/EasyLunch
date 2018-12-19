<?php
namespace Model\Data;
    class User {
        private $userName;
        private $type;

        protected function __construct($userData) {
            $this->userName = $userData["UserName"];
            $this->type = $userData["Type"];
        }
    }
?>