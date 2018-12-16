<?php 
    /**
     * Class that manage the path for php files. 
     * For a correct usage, create in hodocs the folder "progetto" and put "fron-end" inside of it 
     */
    class BaseController {
        private $webSitePath;
        private $globalProductImagePath;
        private $localProductImagePath;
        public function __construct(){
            $this->webSitePath = $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/front-end/';
            $this->localProductImagePath = 'productsimages/';
            $this->globalProductImagePath = $this->webSitePath . $this->localProductImagePath;
        }

        /**
         * Get the web site path.
         */
        public function getWebSitePath(){
            return $this->webSitePath;
        }
        /**
         * Require in the page the file written in filePath
         * @param filepath the local path (after "front-end") of the required file
         */
        public function requireFromWebSitePath($filePath){
            require_once $this->webSitePath . $filePath;
        }

        /**
         * Get the global path for saving images.
         */
        public function getGlobalProductImagePath(){
            return $this->globalProductImagePath;
        }
        /**
         * Get the local path for saving images.
         */
        public function getLocalProductImagePath(){
            return $this->localProductImagePath;
        }
    }
?>
