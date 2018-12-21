<?php
namespace Model;
    class QueryManager {
        
        public function __construct(){ 
            $this->db = new DBManager();
        }

        public function executeQuery($query) {
            return $this->db->getConnection()->query($query);
        }

        private function surroundStrings($array) {
            return array_map(function($val) {
                if (is_string($val)) {
                    return "'" . $val . "'"; 
                } else {
                    return $val; 
                }
            }, $array);
        }

        /**
         * data is a dictionary and the keys must be in the same case format as the ones appearing in the database.
         */
        public function insertInTable($table, $data) {
            $query = "INSERT INTO " . $table . "(" . implode(", ", array_keys($data)) . ") VALUES (" . 
                implode(", ", self::surroundStrings(array_values($data))) . ")";
            return $this->executeQuery($query);
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
            if ($data !== null and $data->num_rows == 1) {
                return $data->fetch_assoc();
            } else {
                return null;
            }
        }
    }
?>