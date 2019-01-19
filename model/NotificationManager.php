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

    public function setRead($orderId) {
        $data["IsRead"] = 1;
        $this->queryManager->updateInTable("Notifications", $data, "orderId", $orderId);
    }

    public function setAllRead($user) {
        $data["IsRead"] = 1;
        $this->queryManager->updateInTable("Notifications", $data, "ReceiverId", $user->userName);
    }

    public function getUnreadNotifications($user) {
        $array = $this->queryManager->searchByDoubleAttribute("Notifications", "ReceiverId", $user->userName, "IsRead", 0);
        $result = [];
        foreach ($array as $data) {
            if (strtotime($data["Timestamp"]) <= time()) {
                array_push($result, new Notification($data["Tipology"], $data["Description"], $data["OrderId"], $data["ReceiverId"], $data["Timestamp"], $data["IsRead"]));
            }
        }
        return $result;
    }
    
    private function newNotification($type, $description, $orderId, $receiverId, $date) {
        return new Notification($type, $description, $orderId, $receiverId, $date, 0);
    }

    private function saveNotification(Notification $notification) {
        $data["Tipology"] = $notification->typology;
        $data["Timestamp"] = $notification->timestamp;
        $data["Description"] = $notification->description;
        $data["OrderId"] = $notification->orderId;
        $data["ReceiverId"] = $notification->receiverId;
        $data["IsRead"] = $notification->isRead;
        return $this->queryManager->insertInTable("Notifications", $data);
    }

    public function createNewOrderNotification($orderData) {
        $description = "Order for " . $orderData["Nominative"] . " at ". $orderData["DeliveryTime"] . " and ". $orderData["DeliverySpot"]. "\n Order details:";
        foreach ($orderData["Products"] as $productData) {
            $description = $description . "\n\t" . $productData["Quantity"] . " " . $productData["ProductName"];
        }
        return $this->saveNotification($this->newNotification("NEW_ORDER", $description, $orderData["Id"], $orderData["ProviderId"], date('Y-m-d G:i:s')));
    }

    public function createOrderComingNotification($orderData, $afterMinutes) {
        $description = "Received order for " . $orderData["Nominative"] . " at ". $orderData["DeliveryPlace"] . "\n Order details:";
        foreach ($orderData["Products"] as $productData) {
            $description = $description . "\n\t" . $productData["Quantity"] . " " . $productData["ProductName"];
        }
        $date = date('Y-m-d G:i:s', strtotime('now +' . $afterMinutes . ' minutes'));
        $description = $description . "\nExpected arrival at: " . $date;
        return $this->saveNotification($this->newNotification("ORDER_COMING", $description, $orderData["Id"], $orderData["ClientId"], date('Y-m-d G:i:s')));
    }

    public function createOrderArrivedNotification($orderData, $afterMinutes) {
        $description = "Arrived order for " . $orderData["Nominative"] . " at ". $orderData["DeliveryPlace"] . "\n Order details:";
        foreach ($orderData["Products"] as $productData) {
            $description = $description . "\n\t" . $productData["Quantity"] . " " . $productData["ProductName"];
        }
        $date = date('Y-m-d G:i:s', strtotime('now +' . $afterMinutes . ' minutes'));
        return $this->saveNotification($this->newNotification("ORDER_ARRIVED", $description, $orderData["Id"], $orderData["ClientId"], $date));
    }
}
?>