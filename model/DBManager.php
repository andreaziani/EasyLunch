<?php 
namespace Model;

//include("QueryManager.php");
    /**
     * Class to manage the db connection and queries.
     */
    class DBManager {
        private $con;
        private $server = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "easy_lunch";
        private $queryManager;
        
        public function __construct(){
            $this->queryManager = new QueryManager();
            $this->con = new mysqli($this->server, $this->user, $this->pass, $this->dbname);
            //check connection 
            if ($this->con->connect_error) {
                die("Connection failed: " . $this->con->connect_error);
            } 
        }

        /**
         * Get the db connection.
         */
        public function getConnection(){
            return $this->con;
        }

        /**
         * Close the connection with db.
         */
        public function closeConnection(){
            $this->con->close();
        }

        public function queryDataToList($data){
            return $this->queryManager->queryDataToList($data);
        }
        
        public function queryDataToObject($data) {
            return $this->queryManager->queryDataToObject($data);
        }
    }

?>
