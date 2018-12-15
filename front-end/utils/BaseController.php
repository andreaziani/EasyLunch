<?php 
    /**
     * Class that manage the path for php files. 
     * For a correct usage, create in hodocs the folder "progetto" and put "fron-end" inside of it 
     */
    class BaseController {
        private $webSitePath;

        public function __construct(){
            $this->webSitePath = $_SERVER['DOCUMENT_ROOT'] . '/progetto/front-end/';
        }
        /**
         * Require in the page the file written in filePath
         * @param filepath the local path (after "front-end") of the required file
         */
        public function requireFromWebSitePath($filePath){
            require_once $this->webSitePath . $filePath;
        }
    }
?>
