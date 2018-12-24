<?php
namespace Model\Data;
    class CartEntry {
        public $productId;
        public $productName;
        public $price;
        public $quantity;

        protected function __construct($data) {
            $this->productId = $data["ProductId"];
            $this->productName = $data["ProductName"];
            $this->price = $data["Price"];
            $this->quantity = $data["Quantity"];
        }

        public function updateQuantity($newQuantity) {
            $this->quantity = $newQuantity;
        }
    }
?>