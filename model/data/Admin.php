<?php
namespace Model\Data;
use Model\Data\User;
    class Admin extends User {
        public $creditPerProduct;

        public function __construct($userData, $adminData) {
            parent::__construct($userData);
            $this->creditPerProduct = $adminData["CreditPerProduct"];
        }
    }
?>