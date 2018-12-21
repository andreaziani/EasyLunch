<?php
namespace Model\Data;
use Model\Data\RegisteredUser;
    class Provider extends RegisteredUser {
        public $address;
        public $iva;
        public function __construct($userData, $registeredData) {
            parent::__construct($userData, $registeredData);
            $this->city = $registeredData["AityAddress"];
            $this->street = $registeredData["AddressStreet"];
            $this->number = $registeredData["AddressNumber"];
            $this->iva = $registeredData["IVA"];
        }
    }
?>