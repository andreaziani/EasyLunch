<?php
namespace Model;

class QueryManager
{
    public $db;

    public function __construct()
    {
        $this->db = new DBManager();
    }

    public function executeQuery($query)
    {
        //TODO sql protection?
        //echo $query;
        //echo "<br/>";
        return $this->db->getConnection()->query($query);
    }

    private function surroundOneString($val)
    {
        if ($val != "NULL" && is_string($val)) {
            return "'" . $val . "'";
        } else {
            return $val;
        }
    }
    
    private function surroundStrings($array)
    {
        return array_map(function ($val) {
            return self::surroundOneString($val);
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

    private function whereSQL($keyName, $keyValue) {
        return " WHERE " . $keyName . "=". self::surroundOneString($keyValue);
    }

    private function andSQL($keyName, $keyValue) {
        return " AND " . $keyName . "=" . self::surroundOneString($keyValue);
    }

    private function updateSQL($table, $data) {
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
        return $query;
    }

    public function deleteFromTableDoubleKeys($table, $key1Name, $key1Value, $key2Name, $key2Value) {
        $query = "DELETE FROM " . $table . self::whereSQL($key1Name, $key1Value) . self::andSQL($key2Name, $key2Value);
        return $this->executeQuery($query);
    }

    /**
     * data is a dictionary and the keys must be in the same case format as the ones appearing in the database.
     */
    public function updateInTable($table, $data, $keyName, $keyValue)
    {
        $query = self::updateSQL($table, $data) . self::whereSQL($keyName, $keyValue);
        return $this->executeQuery($query);
    }

    public function updateInTableDoubleKeys($table, $data, $key1Name, $key1Value, $key2Name, $key2Value) 
    {
        $query = self::updateSQL($table, $data) . self::whereSQL($key1Name, $key1Value) . self::andSQL($key2Name, $key2Value);
        return $this->executeQuery($query);
    }

    public function searchByKey($table, $keyName, $keyValue)
    {
        $query = "SELECT * FROM " . $table . self::whereSQL($keyName, $keyValue);
        return $this->queryDataToObject($this->executeQuery($query));
    }

    public function searchByDoubleKey($table, $key1Name, $key1Value, $key2Name, $key2Value)
    {
        $query = "SELECT * FROM " . $table . self::whereSQL($key1Name, $key1Value) . self::andSQL($key2Name, $key2Value);
        return $this->queryDataToObject($this->executeQuery($query));
    }

    public function searchByAttribute($table, $keyName, $keyValue)
    {
        $query = "SELECT * FROM " . $table . self::whereSQL($keyName, $keyValue);
        return $this->queryDataToList($this->executeQuery($query));
    }

    public function searchByDoubleAttribute($table, $key1Name, $key1Value, $key2Name, $key2Value)
    {
        $query = "SELECT * FROM " . $table . self::whereSQL($key1Name, $key1Value) . self::andSQL($key2Name, $key2Value);
        return $this->queryDataToList($this->executeQuery($query));
    }

    public function searchSmaller($table, $keyName, $keyValue) {
        $query = "SELECT * FROM " . $table . " WHERE " . $keyName . "<". self::surroundOneString($keyValue);
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
        if ($data !== null && $data->num_rows == 1) {
            return $data->fetch_assoc();
        } else {
            return null;
        }
    }

    public function removeFromTable($table, $key1Name, $key1Value){
        $query = "DELETE FROM " . $table . self::whereSQL($key1Name, $key1Value);
        return $this->executeQuery($query);
    }
}
?>