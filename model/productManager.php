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
    
    /*
     * Search if there are products with this name, if not, search by providerid
     */
    public function searchProducts($key){
        $result = $this->queryManager->searchByAttribute("Products", "Name", $key);
        if(count($result) > 0) {
            return $result;
        }
        $result = $this->queryManager->searchByAttribute("Products", "ProviderId", $key);
        if(count($result) > 0) {
            return $result;
        }
        $categories = $this->queryManager->searchByKey("Categories", "Name", $key);
        return $this->queryManager->searchByAttribute("Products", "CategoryId", $categories["Id"]);
    }
}
