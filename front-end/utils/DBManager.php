<?php 
    /**
     * Class to manage the db connection and queries.
     */
    class DBManager {
        private $con;
        private $server = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "easy_lunch";

        
        public function _construct(){
            $this->con = mysqli($server, $user, $pass, $dbname);
            //check connection 
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
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
            $this->conn->close();
        }
    }

?>
