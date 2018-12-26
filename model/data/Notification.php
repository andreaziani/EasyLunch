<?php
namespace Model\Data;
    class Notification {
        public $typology;
        public $timestamp;
        public $description;
        public $orderId;
        public $receiverId;
        public function __construct($type, $description, $orderId, $receiverId) {
            $this->$typology = $type;
            $this->description = $description;
            $this->orderId = $orderId;
            $this->receiverId = $receiverId;
        }
    }
?>