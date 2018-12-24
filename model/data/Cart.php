<?php
namespace Model\Data;
use Model\Data\CartEntry;
    class Cart {
        public $id;
        public $entries = array();

        protected function __construct($cartData, $entriesData) {
            $this->id = $cartData["CartId"];
            foreach ($entriesData as $entryData) {
                $entries[$entrydata["ProductId"]] = new CartEntry($entryData);
            }
        }

        public function addEntry($entry) {
            $entries[$entry->productId] = $entry;
        }
    }
?>