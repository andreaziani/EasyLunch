<?php
namespace Model\Data;
use Model\Data\RegisteredUser;
    class Provider extends RegisteredUser {
        public $address;
        public $iva;
        public function __construct($userData, $registeredData) {
            parent::__construct($userData, $registeredData);
            $this->address = $registeredData["Address"];
            $this->iva = $registeredData["IVA"];
        }
    }
?>