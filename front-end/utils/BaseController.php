<?php 
    class BaseController {
        private $webSitePath;

        public function __construct(){
            $this->webSitePath = $_SERVER['DOCUMENT_ROOT'] . '/front-end/';
        }
        /**
         * Require one the file written in filePath
         * @param filepath the local path of the file to require
         */
        public function requireFromWebSitePath($filePath){
            require_once $this->webSitePath . $filePath;
        }
    }
?>
