<?php
namespace Model\Data;
    class CartEntry {
        public $productName;
        public $price;
        public $quantity;

        protected function __construct($data) {
            $this->productName = $data["ProductName"];
            $this->price = $data["Price"];
            $this->quantity = $data["Quantity"];
        }
    }
?>