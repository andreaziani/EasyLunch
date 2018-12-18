<?php
namespace ProgettoTecWeb\Model;
    class QueryManager {
        
        public function __construct(){ }

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