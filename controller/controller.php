<?php 
    class Controller {
        static $instance = null;
        
        private function _construct(){ }

        public static function getInstance(){
            if($instance == NULL){
                $instance = new Controller();
            }
            return $instance;
        }
        //Methods
    }
?>
