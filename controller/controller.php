<?php
namespace Controller;

use Model\ProductManager;
use Model\UserManager;
use Model\CartManager;
use Model\NotificationManager;
use Model\OrderProvider;
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

    public function removeCategory($id)
    {
        if($this->productManager->removeCategory($id)){
            $this->view->redirect("categories");
        } else {
            $this->startSession();
            $_SESSION["error"] = "Category can't be removed";
            $this->view->redirect("categories");
        }
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
            }
            $this->view->redirect("index");
        } else {
            $this->startSession();
            $_SESSION["error"] = "Username or password not correct";
            $this->view->redirect("loginPage");
        }
    }

    public function register($userData) {
        if ($this->userManager->canRegister($userData) and $this->userManager->register($userData)) {
            $this->startSession();
            $_SESSION["user"] = $this->userManager->getUser($userData["username"]);
            $this->view->redirect("index");
        } else {
            $this->startSession();
            $_SESSION["error"] = "This username is already used";
            $this->view->redirect("registerPage");
        }
        
    }

    public function searchProducts($key, $provider){
        return $this->productManager->searchProducts($key, $provider);
    }

    public function searchProvider($key){
        return $this->productManager->searchProvider($key);
    }

    public function logout(){
        $this->startSession();
        session_destroy();
        $this->view->redirect("index");
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
            foreach ($this->cartManager->getOrders($_SESSION["cart"]) as $order) {
                $this->cartManager->startOrder($order);
                $this->notificationManager->createNewOrderNotification($this->cartManager->getOrderData($order));
            }
            $this->userManager->removeCart($_SESSION["user"]);
            unset($_SESSION["cart"]);
        }
        $this->view->redirect("index");
    }

    public function addProductToCart($data){
        $this->startSession();
        if(!isset($_SESSION["cart"]) || $_SESSION["cart"] == ''){
            $_SESSION["cart"] = $this->cartManager->createCart($_SESSION["user"]);
        }
        return $this->cartManager->addProductToCart($_SESSION["cart"], new \Model\Data\CartEntry($data));
    }

    public function updateCartEntry($productId, $newQuantity) {
        $this->startSession();
        return $this->cartManager->updateProductInCart($_SESSION["cart"], $productId, $newQuantity);
    }

    public function dropCartEntry($productId) {
        $this->startSession();
        return $this->cartManager->removeProductFromCart($_SESSION["cart"], $productId);
    }

    public function getNotifications() {
        $this->cartManager->checkOrdersArriving();
        $_SESSION["notifications"] = $this->notificationManager->getUnreadNotifications($_SESSION["user"]);
        return $_SESSION["notifications"];
    }

    public function tryReview($orderId) {
        if ($this->userManager->canReview($_SESSION["user"], $orderId)) {
            $_SESSION["order"] = $orderId;
            echo $this->view->getHref("reviewPage");
        }
    }
    
    public function trySend($orderId) {
        if ($this->userManager->canSend($_SESSION["user"], $orderId)) {
            $_SESSION["order"] = $orderId;
            echo $this->view->getHref("sendOrderPage");
        }
    }
    
    public function setRead() {
        $this->notificationManager->setAllRead($_SESSION["user"]);
        echo $this->view->getHref("index");
    }

    public function submitReview($description, $rank) {
        if ($this->userManager->canReview($_SESSION["user"], $_SESSION["order"])) {
            $this->userManager->submitReview($_SESSION["order"], $description, $rank);
            $this->cartManager->setOrderCompleted($_SESSION["order"]);
            //$this->notificationManager->setRead($_SESSION["order"]);
            unset($_SESSION["order"]);
        }
        $this->view->redirect("ordersPage");
    }

    public function insertCategory($name){
        if($this->productManager->insertCategory($name)){
            $this->view->redirect("categories");
        } else {
            $this->startSession();
            $_SESSION["error"] = "Category already present";
            $this->view->redirect("categories");
        }
    }
    
    public function sendOrder($orderId, $minutes) {
        $order = $this->cartManager->getOrder($orderId);
        $orderData = $this->cartManager->getOrderData($order);
        $this->notificationManager->createOrderComingNotification($orderData, $minutes);
        $this->notificationManager->createOrderArrivedNotification($orderData, $minutes);
        $this->cartManager->setOrderArriving($order);
        $this->view->redirect("ordersPage");
    }

    /**
     * Method to redirect the page when the action inputs are wrong.
     */
    public function actionError() {
        $this->view->redirect("index");
    }
    /**
     * Utility method for check if a session is already started.
     */
    private function startSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $_SESSION["orderProvider"] = new OrderProvider();
        }
    }
}
?>