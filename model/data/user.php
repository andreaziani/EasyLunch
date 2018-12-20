<?php
namespace Model\Data;
    class User {
        public $userName;
        public $type;

        protected function __construct($userData) {
            $this->userName = $userData["UserName"];
            $this->type = $userData["Type"];
        }
    }
?>