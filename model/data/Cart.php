<?php
namespace Model\Data;
use Model\Data\CartEntry;
    class Cart {
        public $id;
        public $entries = array();

        public function __construct($cartData, $entriesData) {
            $this->id = $cartData["Id"];
            //var_dump($entriesData);
            foreach ($entriesData as $entryData) {
                $this->entries[$entryData["ProductId"]] = new CartEntry($entryData);
            }
        }

        public function addEntry($entry) {
            $this->entries[$entry->productId] = $entry;
        }
    }
?>