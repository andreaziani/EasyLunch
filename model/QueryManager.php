<?php
    class QueryManager {
        
        public function __construct(){
            
        }

        public function queryDataToList($data) {
            if ($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    $result[] = $row["valore"];
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