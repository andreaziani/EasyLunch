<?php
namespace Model;
use Model\DBManager;
use Utils\PathManager;

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
        $this->db->getConnection()->query($query);
    }

    public function removeProduct($id)
    {
        $query = "DELETE FROM Products
              WHERE Id=" . $id;

        if ($this->db->getConnection()->query($query) === true) {
            echo "Record updated successfully";
        } else {
            echo $this->db->getConnection()->error;
        }
    }

    public function modifyProduct($name, $description, $price, $id)
    {
        $query = "UPDATE Products
              SET Name='" . $name .
            "', Description='" . $description .
            "', Price=" . $price .
            "  WHERE Id=" . $id;

        if ($this->db->getConnection()->query($query) === true) {
            echo "Record updated successfully";
        } else {
            echo $this->db->getConnection()->error;
        }
    }
}
