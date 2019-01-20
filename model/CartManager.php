<?php
namespace Model;
use Model\Data\{Cart, CartEntry};
use Utils\PathManager;

class CartManager
{
    private $queryManager;
    public function __construct()
    {
        $this->queryManager = new QueryManager();
    }

    public function getCart($id) {
        return new Cart($this->queryManager->searchByKey("Carts", "Id", $id), $this->queryManager->searchByAttribute("CartData", "CartId", intval($id)));
    }

    public function getOrder($orderId) {
        return $this->queryManager->searchByKey("Orders", "Id", $orderId);
    }

    public function findOrCreateOrder($cart, $providerId) {
        $order = $this->queryManager->searchByDoubleKey("Orders", "CartId", intval($cart->id), "ProviderId", $providerId);
        if ($order == null) {
            $order = array();
            $order["CartId"] = intval($cart->id);
            $order["ProviderId"] = $providerId;
            $this->queryManager->insertInTable("Orders", $order);
            $order = $this->queryManager->searchByDoubleKey("Orders", "CartId", intval($cart->id), "ProviderId", $providerId);
        }
        return $order;
    }

    public function createCart($user) {
        $data["ClientId"] = $user->userName;
        if ($this->queryManager->insertInTable("Carts", $data)) {
            //TODO maybe can be done better
            $cartData = $this->queryManager->searchByAttribute("Carts", "ClientId", $user->userName);
            $cart = new Cart($cartData[count($cartData) - 1], array());
            $user->currentCartId = $cart->id;
            $userData["CurrentCartId"] = intval($user->currentCartId);
            $this->queryManager->updateInTable("Clients", $userData, "UserName", $user->userName);
            return $cart;
        }
        return null;
    }

    public function removeProductFromCart($cart, $productId) {
        if (isset($cart->entries[$productId])) {
            $entry = $cart->entries[$productId];
            $providerId = $this->queryManager->searchByKey("Products", "Id", $entry->productId)["ProviderId"];
            $order = $this->findOrCreateOrder($cart, $providerId);
            unset($cart->entries[$productId]);
            return $this->queryManager->deleteFromTableDoubleKeys("OrderEntries", "ProductId", $productId, "OrderId", $order["Id"]);
        }
    }

    public function updateProductInCart($cart, $productId, $newQuantity) {
        if (!isset($cart->entries[$productId])) {
            return false;
        }
        if ($newQuantity > 0 && $newQuantity != $cart->entries[$productId]->quantity) {
            $cart->entries[$productId]->updateQuantity($newQuantity);
            $entry = $cart->entries[$productId];
            $providerId = $this->queryManager->searchByKey("Products", "Id", $entry->productId)["ProviderId"];
            $order = $this->findOrCreateOrder($cart, $providerId);
            $entryData["Quantity"] = $entry->quantity;
            return $this->queryManager->updateInTableDoubleKeys("OrderEntries", $entryData, "ProductId", $productId, "OrderId", $order["Id"]);
        } else {
            return $this->removeProductFromCart($cart, $productId);
        }
    }

    public function addProductToCart($cart, $entry) {
        $result = false;
        $providerId = $this->queryManager->searchByKey("Products", "Id", intval($entry->productId))["ProviderId"];
        $order = $this->findOrCreateOrder($cart, $providerId);
        $entryData["ProductId"] = intval($entry->productId);
        $entryData["Quantity"] = intval($entry->quantity);
        $entryData["Price"] = floatval($entry->price);
        $entryData["OrderId"] = intval($order["Id"]);
        if (isset($cart->entries[$entry->productId])) {
            $result = $this->updateProductInCart($cart, $entry->productId, $entry->quantity);
        } else if ($entry->quantity > 0) {
            $cart->addEntry($entry);
            $result = $this->queryManager->insertInTable("OrderEntries", $entryData);
        }
        return $result;
    }

    public function checkout($cart, $nominative, $spot, $dateTime) {
        $data["CartId"] = intval($cart->id);
        $data["Nominative"] = $nominative;
        $data["DeliverySpot"] = $spot;
        $data["DeliveryTime"] = $dateTime;
        return $this->queryManager->insertInTable("Purchases", $data);
    }

    public function getOrders($cart) {
        return $this->queryManager->searchByAttribute("Orders", "CartId", $cart->id);
    }

    public function startOrder($order) {
        $data["State"] = "STARTED";
        return $this->queryManager->updateInTable("Orders", $data, "Id", $order["Id"]);
    }

    public function setOrderArrived($order) {
        $data["State"] = "ARRIVED";
        return $this->queryManager->updateInTable("Orders", $data, "Id", $order["Id"]);
    }

    public function getOrderData($order) {
        $clientId = $this->queryManager->searchByKey("Carts", "Id", $order["CartId"])["ClientId"];
        $purchase = $this->queryManager->searchByKey("Purchases", "CartId", $order["CartId"]);
        $data = $this->queryManager->searchByAttribute("OrderData", "OrderId", $order["Id"]);
        $orderData["Nominative"] = $purchase["Nominative"];
        $orderData["DeliverySpot"] = $purchase["DeliverySpot"];
        $orderData["DeliveryTime"] = $purchase["DeliveryTime"];
        $orderData["Id"] = $order["Id"];
        $orderData["ClientId"] = $clientId;
        $orderData["ProviderId"] = $data[0]["ProviderId"];
        $orderData["Products"] = array();
        foreach ($data as $p) {
            $pData["ProductId"] = $p["ProductId"];
            $pData["ProductName"] = $p["ProductName"];
            $pData["Quantity"] = $p["Quantity"];
            array_push($orderData["Products"], $pData);
        }
        return $orderData;
    }
}
?>