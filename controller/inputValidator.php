<?php
namespace Controller;
    class InputValidator {
        
        public function __construct(){ }

        public static function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
?>