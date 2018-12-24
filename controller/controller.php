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

    public function removeProduct($id)
    {
        $this->productManager->removeProduct($id);
        $this->view->redirect("providerProductsList");
    }

    public function modifyProduct($name, $description, $price, $id)
    {
        $this->productManager->modifyProduct($name, $description, $price, $id);
        $this->view->redirect("providerProductsList");
    }

    public function login($username, $password) {
        if ($this->userManager->verifyLogin($username, $password)) {
            $this->startSession();
            $_SESSION["user"] = $this->userManager->getUser($username);
            $this->view->redirect("mainPage");
        } else {
            $this->view->redirect("loginPage");
        }
    }

    public function register($userData) {
        if ($this->userManager->canRegister($userData) and $this->userManager->register($userData)) {
            $this->startSession();
            $_SESSION["user"] = $this->userManager->getUser($username);
            $this->view->redirect("mainPage");
        } else {
            $this->view->redirect("registerPage");
        }
        
    }

    public function searchProducts($key){
        return $this->productManager->searchProducts($key);
    }

    public function logout(){
        $this->startSession();
        session_destroy();
        $this->view->redirect("mainPage");
    }
    
    public function updateProfileInformations($data, $tableName, $username){
        if($this->userManager->updateProfileInformations($data, $tableName, $username) > 0){
            $_SESSION["user"] = $this->userManager->getUser($username);
            switch($tableName){
                case "Clients":
                    $this->view->redirect("clientProfile");
                    break;
                case "Providers":
                    $this->view->redirect("providerProfile");
                    break;
            }
        }
    }

    public function addProductToCart($data){
        //return $cartManager->addEntry(new \Model\Data\CartEntry($data));
    }

    /**
     * Utility method for check if a session is already started.
     */
    private function startSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}

