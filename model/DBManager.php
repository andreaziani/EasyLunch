<?php 
namespace Model;
    /**
     * Class to manage the db connection and queries.
     */
    class DBManager {
        private $con;
        private $server = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "easy_lunch";
        
        public function __construct(){
            $this->con = new \mysqli($this->server, $this->user, $this->pass, $this->dbname);
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
    }

?>
