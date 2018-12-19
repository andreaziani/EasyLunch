<?php
namespace Model;
    class QueryManager {
        
        public function __construct(){ 
            $this->db = new DBManager();
        }

<<<<<<< HEAD
        private function executeQuery($query) {
=======
        public function executeQuery($query) {
>>>>>>> 416d3ac31d12a1038f356d5cba4d24b6c145bf12
            return $this->db->getConnection()->query($query);
        }

        public function searchByKey($table, $keyName, $keyValue) {
            if (is_string($keyValue)) {
                $keyValue = "'" . $keyValue . "' ";
            }
            $query = "SELECT * FROM " . $table . " WHERE " . $keyName . " = " . $keyValue;
            return $this->queryDataToObject($this->executeQuery($query));
        }

        public function queryDataToList($data) {
            $result = array();
            if ($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    array_push($result, $row);
                }
            }
            return $result;
        }

        public function queryDataToObject($data) {
            if ($data->num_rows == 1) {
                return $data->fetch_assoc();
            } else {
                return null;
            }
        }
    }
?>