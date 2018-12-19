<?php
namespace Controller;

use Model\ProductManager;
use Model\UserManager;
use View\View;

class Controller
{
    static $instance = null;
    private $productManager;
    private $userManager;
    private $view;
    public function __construct()
    {
        $this->productManager = new ProductManager();
        $this->userManager = new UserManager();
        $this->view = View::getInstance();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Controller();
        }
        return self::$instance;
    }

    public function insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category)
    {
        $this->productManager->insertProduct($provider, $name, $description, $price, $tmp_name, $filename, $category);
        $this->view->redirect("providerProductsList");
    }

    public function removeProduct($name, $provider)
    {
        $this->productManager->removeProduct($name, $provider);
        $this->view->redirect("providerProductsList");
    }

    public function modifyProduct($name, $description, $price, $provider)
    {
        $this->productManager->modifyProduct($name, $description, $price, $provider);
        $this->view->redirect("providerProductsList");
    }

    public function login($username, $password) {
        if ($this->userManager->verifyLogin($username, $password)) {
            session_start();
            $_SESSION["user"] = $this->userManager->getUser($username);
            $this->view->redirect("mainPage");
        }
    }
}
