<?php
namespace Model;
use Model\QueryManager;
use Model\Data\Notification;

class NotificationKey 
{
    public $type;
    public $orderId;
    public function __construct($type, $oderId)
    {
        $this->type = $type;
        $this->orderId = $oderId;
    }
}

class NotificationManager
{
    private $queryManager;
    public function __construct()
    {
        $this->queryManager = new QueryManager();
    }

    public function setNotificationRead($user) {
        $data["IsRead"] = 1;
        $this->queryManager->updateInTable("Notifications", $data, "ReceiverId", $user->userName);
    }

    public function getUnreadNotifications($user) {
        return $this->queryManager->searchByDoubleAttribute("Notifications", "ReceiverId", $user->userName, "IsRead", 0);
    }
    
    public function createNewOrderNotification($orderData) {
        $description = "Order for " . $orderData["Nominative"] . " at ". $orderData["DeliveryTime"] . " and ". $orderData["DeliverySpot"] . "\n Order details:";
        foreach ($orderData["Products"] as $productData) {
            $description = $description . "\n" . $productData["Quantity"] . " " . $productData["ProductName"] . " (" . $productData["ProductId"] . ")";
        }
        return new Notification("NEW_ORDER", $description, $orderData["Id"], $orderData["ProviderId"]);
    }

    public function createOrderArrivedNotification($orderData) {
        $description = "Arrived order for " . $orderData["Nominative"] . " at ". $orderData["DeliveryPlace"] . "\n Order details:";
        foreach ($orderData["Products"] as $productData) {
            $description = $description . "\n" . $productData["Quantity"] . " " . $productData["ProductName"] . " (" . $productData["ProductId"] . ")";
        }
        return new Notification("ORDER_ARRIVED", $description, $orderData["Id"], $orderData["ClientId"]);
    }

    public function createReviewNotification($orderData) {
        $description = "Review available for order ";
        return new Notification("REVIEW", $description, $orderData["Id"], $orderData["ClientId"]);
    }
}
?>