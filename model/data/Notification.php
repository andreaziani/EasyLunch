<?php
namespace Model\Data;
    class Notification {
        public $typology;
        public $timestamp;
        public $description;
        public $orderId;
        public $receiverId;
        public $isRead;
        public function __construct($type, $description, $orderId, $receiverId, $time, $isRead) {
            $this->typology = $type;
            $this->description = $description;
            $this->orderId = $orderId;
            $this->receiverId = $receiverId;
            $this->timestamp = $time;
            $this->isRead = $isRead;
        }

        public function cmp($other) {
            return $this->timestamp - $other->timestamp;
        }
    }
?>