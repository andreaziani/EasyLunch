<?php
namespace Controller;

use Model\ProductManager;
use Model\UserManager;
use Model\CartManager;
use Model\NotificationManager;
use View\View;

class Controller
{
    static $instance = null;
    private $productManager;
    private $userManager;
    private $cartManager;
    private $notificationManager;
    private $view;
    public function __construct()
    {
        $this->productManager = new ProductManager();
        $this->userManager = new UserManager();
        $this->cartManager = new CartManager();
        $this->notificationManager = new NotificationManager();
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
            if ($_SESSION["user"]->currentCartId != null) {
                $_SESSION["cart"] = $this->cartManager->getCart($_SESSION["user"]->currentCartId);
                var_dump($this->cartManager->getCart($_SESSION["user"]->currentCartId));
            }
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

    public function checkoutOrder($nominative, $spot, $dateTime) {
        if ($this->cartManager->checkout($_SESSION["cart"], $nominative, $spot, $dateTime)) {
            foreach ($this->cartManager->getOrders($cart) as $order) {
                $this->notificationManager->createNewOrderNotification($this->cartManager->getOrderData($order));
            }
        }
        $this->view->redirect("mainPage");
    }

    public function addProductToCart($data){
        self::startSession();
        if(!isset($_SESSION["cart"])){
            $_SESSION["cart"] = $this->cartManager->createCart($_SESSION["user"]);
        }
        return $this->cartManager->addProductToCart($_SESSION["cart"], new \Model\Data\CartEntry($data));
    }

    public function getNotifications() {
        $_SESSION["notifications"] = $this->notificationManager->getUnreadNotifications($_SESSION["user"]);
        return $_SESSION["notifications"];
    }

    public function tryReview($orderId) {
        if ($this->userManager()->canReview($_SESSION["user"], $orderId)) {
            $_SESSION["order"] = $orderId;
            $this->view->redirect("reviewPage");
        } else {
            $this->view->redirect("mainPage");
        }
    }

    public function submitReview($description, $rank) {
        if ($this->userManager()->canReview($_SESSION["user"], $_SESSION["order"])) { //TODO check if if is useful
            $this->userManager()->submitReview($_SESSION["order"], $description, $rank);
            unset($_SESSION["order"]);
        }
        $this->view->redirect("mainPage");
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
?>