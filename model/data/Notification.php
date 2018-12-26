<?php
namespace Model\Data;
    class Notification {
        public $typology;
        public $timestamp;
        public $description;
        public $orderId;
        private function __construct($type, $description, $orderId) {
            $this->$typology = $type;
        }

        public static function createNewOrderNotification($orderData) {
            $description;
            foreach ($orderData["products"] as $productData) {
                $description = $description . "\n" . $productData["quantity"] . " " . $productData["productName"] . " (" . $productData["productId"] . ")";
            }
            return new Notification("NEW_ORDER", $description, $orderData["id"]);
        }
    }
?>