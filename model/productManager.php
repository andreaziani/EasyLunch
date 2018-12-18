<?php
include "../utils/pathManager.php";
include "DBManager.php";

class ProductManager
{
    private $db;
    private $pathManager;
    public function __construct()
    {
        $this->db = new DBManager();
        $this->pathManager = new PathManager();
    }

    public function insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category)
    {
        move_uploaded_file($tmp_name, $this->pathManager->uploadPath . $filename); // Move the uploaded file to the desired folder
        $query = "INSERT INTO Products(Name, Description, Image, Price, IsActive, CategoryId, ProviderId)
                  VALUES (" . "'" . $name . "', '" . $description . "', '" . $this->pathManager->dirUpload . $filename . "'," .
            $price . ", TRUE, " . $category . ",'" . $provider . "')";
        $db->getConnection()->query($query);
    }

    public function removeProduct($name, $provider)
    {
        $query = "DELETE FROM Products
              WHERE Name='" . $name . "' AND ProviderId='" . $provider . "'";

        if ($db->getConnection()->query($query) === true) {
            echo "Record updated successfully";
        } else {
            echo $db->getConnection()->error;
        }
    }

    public function modifyProduct($name, $description, $price, $provider)
    {
        $query = "UPDATE Products
              SET Name='" . $name .
            "', Description='" . $description .
            "', Price=" . $price .
            "  WHERE ProviderId='" . $provider .
            "' AND Name='" . $name . "'";

        if ($db->getConnection()->query($query) === true) {
            echo "Record updated successfully";
        } else {
            echo $db->getConnection()->error;
        }
    }
}
