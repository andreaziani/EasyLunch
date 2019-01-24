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
        //$this->queryManager->db = new DBManager();
        $queryManager = new QueryManager();
        $key = "";
        if ($user->type === "CLIENT") {
            $key = "ClientId";
        } else if ($user->type === "PROVIDER") {
            $key = "ProviderId";
        } else {
            return [];
        }
        $result = $queryManager->searchByAttribute("VisibleOrders", $key, $user->userName);
        usort($result, function($a, $b) {
            if ($b["State"] === "COMPLETED") {
                return -1;
            } else if ($a["State"] === "COMPLETED") {
                return 1;
            } else if ($b["State"] === "ARRIVED") {
                return -1;
            } else if ($a["State"] === "ARRIVED") {
                return 1;
            } else if ($b["State"] === "ARRIVING") {
                return -1;
            } else if ($a["State"] === "ARRIVING") {
                return 1;
            } else {
                return 0;
            }
        });
        return $result;
    }
}
