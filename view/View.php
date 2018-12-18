<?php
namespace View;

class View
{
    private $listTemplate = array(
        "index" => "index.php",
        "providerProductsList" => "template/providerproductslist/providerProductsList.php",
        "loginPage" => "template/access/loginPage.php",
    );
    static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if ($instance == null) {
            $instance = new View();
        }
        return $instance;
    }

    public function redirect($name){
        header("location: " . $this->listTemplate[$name]);
    }
}
