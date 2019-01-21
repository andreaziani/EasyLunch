<?php
namespace Model;
use Model\DBManager;
use Model\QueryManager;
use Utils\PathManager;

class ProductManager
{
    private $pathManager;
    private $queryManager;
    public function __construct()
    {
        $this->pathManager = new PathManager();
        $this->queryManager = new QueryManager();
    }

    public function insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category)
    {
        move_uploaded_file($tmp_name, $this->pathManager->uploadPath . $filename); // Move the uploaded file to the desired folder
        $data = array();
        $data["Name"] = $name;
        $data["Description"] = $description;
        $data["Image"] = $this->pathManager->dirUpload . $filename;
        $data["Price"] = $price;
        $data["IsActive"] = 1;
        $data["CategoryId"] = $category;
        $data["ProviderId"] = $provider;
        $prev = $this->queryManager->searchByAttribute("Products", "Name", $name);
        
        //TODO: manage previous version id
        $this->queryManager->insertInTable("Products", $data);
    }

    public function removeProduct($id)
    {
        $data = array();
        $data["IsActive"] = 0;
        $this->queryManager->updateInTable("Products", $data, "Id", $id);
    }

    public function modifyProduct($name, $description, $price, $id)
    {
        $data = array();
        $data["Name"] = $name;
        $data["Description"] = $description;
        $data["Price"] = $price;
        $this->queryManager->updateInTable("Products", $data, "Id", $id);
    }
    
    public function searchProducts($key, $provider) {
        $query = "SELECT * FROM Products WHERE Name='" . $key . "' AND ProviderId='" . $provider . "' AND IsActive=true"; 
        $result = $this->queryManager->queryDataToList($this->queryManager->executeQuery($query));
        if(count($result) > 0) {
            return $result;
        }
        $categories = $this->queryManager->searchByKey("Categories", "Name", $key);
        $query = "SELECT * FROM Products WHERE CategoryId=" . $categories["Id"] . " AND ProviderId='" . $provider . "' AND IsActive=true"; 
        return $this->queryManager->queryDataToList($this->queryManager->executeQuery($query));
    }

    public function searchProvider($key){
        $result = $this->queryManager->searchByAttribute("Providers", "CompanyName", $key);
        //var_dump($result);
        $rate_query = "SELECT AVG(Rank) FROM ProvidersReviews WHERE ProviderId='" . $result[0]["UserName"] . "'";
        $rate = $this->queryManager->queryDataToObject($this->queryManager->executeQuery($rate_query));
        $result[0]["Rate"] = $rate["AVG(Rank)"];
        return $result;
    }

    public function insertCategory($name){
        $query = "INSERT INTO Categories(Name) VALUES('" . $name . "')";
        return $this->queryManager->executeQuery($query);
    }

    public function removeCategory($id){
        return $this->queryManager->removeFromTable("Categories", "Name", $id);
    }
}
