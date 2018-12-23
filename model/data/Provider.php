<?php
namespace Model\Data;
use Model\Data\RegisteredUser;
    class Provider extends RegisteredUser {
        public $companyName;
        public $city;
        public $street;
        public $number;
        public $iva;
        public function __construct($userData, $registeredData) {
            parent::__construct($userData, $registeredData);
            $this->companyName = $registeredData["CompanyName"];
            $this->city = $registeredData["CityAddress"];
            $this->street = $registeredData["AddressStreet"];
            $this->number = $registeredData["AddressNumber"];
            $this->iva = $registeredData["IVA"];
        }
    }
?>