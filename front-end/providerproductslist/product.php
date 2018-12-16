<?php 
    /**
     * Class that rapresent the product.
     */
    class Product {
        private $id;
        private $name;
        private $description;
        private $imagePath;
        private $price;
        private $isActive = true;
        private $previousId = null;
        private $categoryId;
        private $providerId;
        
        /**
         * Build new product by passing his name, description, price and the path of the image.
         */
        public function __construct($name, $description, $image, $price, $categoryId, $providerId){
            $this->name = $name;
            $this->description = $description;
            $this->imagePath = $image;
            $this->price = $price;
            $this->categoryId = $categoryId;
            $this->providerId = $providerId;
        }

        public function getName(){
            return $this->name;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getImagePath(){
            return $this->imagePath;
        }

        public function getPrice(){
            return $this->price;
        }

        public function isProductActive(){
            return $this->isActive;
        }

        public function getCategory(){
            return $this->categoryId;
        }

        public function getProvider(){
            return $this->providerId;
        }

        public function setPreviousId($id){
            $this->previousId = $id;
        }

        public function getPreviousId(){
            return $this->previousId;
        }
    }
?>
