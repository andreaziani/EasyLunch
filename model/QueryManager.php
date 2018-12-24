<?php
namespace Model;

class QueryManager
{

    public function __construct()
    {
        $this->db = new DBManager();
    }

    public function executeQuery($query)
    {
        return $this->db->getConnection()->query($query);
    }

    private function surroundOneString($val)
    {
        if (is_string($val)) {
            return "'" . $val . "'";
        } else {
            return $val;
        }
    }
    
    private function surroundStrings($array)
    {
        return array_map(function ($val) {
            self::surroundOneString($val);
        }, $array);
    }


    /**
     * data is a dictionary and the keys must be in the same case format as the ones appearing in the database.
     */
    public function insertInTable($table, $data)
    {
        $query = "INSERT INTO " . $table . "(" . implode(", ", array_keys($data)) . ") VALUES (" .
        implode(", ", self::surroundStrings(array_values($data))) . ")";
        return $this->executeQuery($query);
    }

    /**
     * data is a dictionary and the keys must be in the same case format as the ones appearing in the database.
     */
    public function updateInTable($table, $data, $keyName, $keyValue)
    {
        $query = "UPDATE " . $table . " SET ";
        $i = 0; //Tried with string manipulation but it doesn't work. On the contrary Brute force has worked.
        $len = count($data);
        foreach ($data as $key => $value) {
            $query = $query . $key . "=" . self::surroundOneString($value);
            if($i != $len - 1){
                $query = $query . ", ";
            }
            $i++;
        }
        $query = $query . " WHERE " . $keyName . "=". self::surroundOneString($keyValue); 
        //echo $query;
        return $this->executeQuery($query);
    }

    public function searchByKey($table, $keyName, $keyValue)
    {
        $keyValue = self::surroundOneString($keyValue);
        $query = "SELECT * FROM " . $table . " WHERE " . $keyName . " = " . $keyValue;
        return $this->queryDataToObject($this->executeQuery($query));
    }

    public function searchByDoubleKey($table, $key1Name, $key1Value, $key2Name, $key2Value)
    {
        $key1Value = self::surroundOneString($key1Value);
        $key2Value = self::surroundOneString($key2Value);
        $query = "SELECT * FROM " . $table . " WHERE " . $key1Name . " = " . $key1Value . " AND " . $key2Name . " = " . $key2Value;
        return $this->queryDataToObject($this->executeQuery($query));
    }

    public function searchByAttribute($table, $keyName, $keyValue)
    {
        if (is_string($keyValue)) {
            $keyValue = "'" . $keyValue . "' ";
        }
        $query = "SELECT * FROM " . $table . " WHERE " . $keyName . " = " . $keyValue;
        return $this->queryDataToList($this->executeQuery($query));
    }

    public function queryDataToList($data)
    {
        $result = array();
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                array_push($result, $row);
            }
        }
        return $result;
    }

    public function queryDataToObject($data)
    {
        if ($data !== null and $data->num_rows == 1) {
            return $data->fetch_assoc();
        } else {
            return null;
        }
    }
}
