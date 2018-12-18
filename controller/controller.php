<?php
namespace Controller;
use Model\ProductManager;
use Model\UserManager;

class Controller
{
    static $instance = null;
    private $productManager;
    private $userManager;
    private function _construct()
    {
        $this->productManager = new ProductManager();
        $this->userManager = new UserManager();
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

    public function login($username, $password) {
        if ($this->userManager->verifyLogin($username, $password)) {
            session_start();
            $_SESSION["user"] = $this->userManager->getUser($username);
        }
    }
}
