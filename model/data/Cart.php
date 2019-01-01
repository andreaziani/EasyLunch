<?php
namespace Model\Data;
use Model\Data\CartEntry;
    class Cart {
        public $id;
        public $entries = array();

        public function __construct($cartData, $entriesData) {
            $this->id = $cartData["Id"];
            foreach ($entriesData as $entryData) {
                $entries[$entrydata["ProductId"]] = new CartEntry($entryData);
            }
        }

        public function addEntry($entry) {
            $this->entries[$entry->productId] = $entry;
        }
    }
?>