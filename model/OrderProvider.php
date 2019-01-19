<?php
namespace Model;
use Model\QueryManager;

class OrderProvider
{
    private $queryManager;
    public function __construct()
    {
        $this->queryManager = new QueryManager();
    }

    public function getOrders($user) {
        $key = "";
        if ($user->type === "CLIENT") {
            $key = "ClientId";
        } else if ($user->type === "PROVIDER") {
            $key = "ProviderId";
        } else {
            return [];
        }
        return $this->queryManager->searchByAttribute("VisibleOrders", $key, $user->userName);
    }
}
