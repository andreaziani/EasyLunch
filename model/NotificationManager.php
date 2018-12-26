<?php
namespace Model;
use Model\QueryManager;
use Model\Data\Notification;

class NotificationManager
{
    private $queryManager;
    public function __construct()
    {
        $this->queryManager = new QueryManager();
    }

//TODO how to get notification?

    public function addNotification($orderData) {
        $notification = new Notification($oderData);
        $data["Typology"] = $notification->typology;
        $data["Description"] = $notification->description;
        $data["OrderId"] = $notification->orderId;
        $this->queryManager->insertInTable($notification);
    }
}
