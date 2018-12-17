<?php
    class QueryManager {
        public queryDataToList($data) {
            if ($data->num_rows > 0) {
                while($row = $data->fetch_assoc()) {
                    $result[] = $row["valore"];
                }
            }
            return $result;
        }
        public queryDataToObject($data) {
            if ($data->num_rows == 1) {
                return $data->fetch_assoc();
            } else {
                return null;
            }
        }
    }
?>