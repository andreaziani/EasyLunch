<?php
namespace View;

class View
{
    private $listTemplate = array(
        "index" => "/ProgettoTecWeb/view/index.php",
        "providerProductsList" => "/ProgettoTecWeb/view/template/providerproductslist/providerProductsList.php",
        "loginPage" => "/ProgettoTecWeb/view/template/access/loginPage.php",
        "registerPage" => "/ProgettoTecWeb/view/template/access/registerPage.php",
        "mainPage" => "/ProgettoTecWeb/view/template/mainPage.php",
        "providerProfile" => "/ProgettoTecWeb/view/template/profile/providerProfile.php",
        "clientProfile" => "/ProgettoTecWeb/view/template/profile/clientProfile.php",
        "reviewPage" => "/ProgettoTecWeb/view/template/review/reviewPage.php",
        "categories" => "/ProgettoTecWeb/view/template/admin/categories.php",
        "sendOrderPage" => "/ProgettoTecWeb/view/template/sendorder/sendOrderPage.php",
        "ordersPage" => "/ProgettoTecWeb/view/template/orders/orderPage.php"
    );
    static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new View();
        }
        return self::$instance;
    }

    public function getHref($name) {
        return $this->listTemplate[$name];
    }

    public function redirect($name){
        header("location: " . $this->listTemplate[$name]);
    }
}
