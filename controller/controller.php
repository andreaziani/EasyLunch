<?php
namespace ProgettoTecWeb\Controller;
use ProgettoTecWeb\Model\ProductManager;

class Controller
{
    static $instance = null;
    private $productManager;
    private function _construct()
    {
        $this->productManager = new ProductManager();
    }

    public static function getInstance()
    {
        if ($instance == null) {
            $instance = new Controller();
        }
        return $instance;
    }

    public function insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category)
    {
        $this->productManager->insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category);
    }

    public function removeProduct($name, $provider)
    {
        $this->productManager->removeProduct($name, $provider);
    }

    public function modifyProduct($name, $description, $price, $provider)
    {
        $this->productManager->modifyProduct($name, $description, $price, $provider);
    }
}
