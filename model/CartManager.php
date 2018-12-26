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
        return new Cart($this->queryManager->searchByKey("Carts", "Id", $id));
    }

    public function findOrCreateOrder($cart, $providerId) {
        $order = $this->queryManager->searchByDoubleKey("Orders", "Id", intval($cart->id), "ProviderId", $providerId);
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

    public function updateProductInCart($cart, $productId, $newQuantity) {
        $cart->entries[$productId]->updateQuantity($newQuantity);
        $entry = $cart->entries[$productId];
        $providerId = $this->queryManager->searchByKey("Products", "Id", $entry->productId)["ProviderId"];
        $order = $this->findOrCreateOrder($cart, $providerId);
        $entryData["Quantity"] = $entry->quantity;
        $this->queryManager->updateInTableDoubleKeys("OrderEntries", $entryData, "ProductId", $entry->productId, "OrderId", $entry->orderId);
    }

    public function addProductToCart($cart, $entry) {
        $cart->addEntry($entry);
        $providerId = $this->queryManager->searchByKey("Products", "Id", intval($entry->productId))["ProviderId"];
        $order = $this->findOrCreateOrder($cart, $providerId);
        $entryData["OrderProductId"] = intval($entry->productId);
        $entryData["Quantity"] = intval($entry->quantity);
        $entryData["Price"] = floatval($entry->price);
        $entryData["OrderId"] = intval($order["Id"]);
        return $this->queryManager->insertInTable("OrderEntries", $entryData);
    }

    public function checkout($cart, $nominative, $spot, $dateTime) {
        $data["CartId"] = $cart->id;
        $data["Nominative"] = $nominative;
        $data["DeliverySpot"] = $spot;
        $data["DeliveryTime"] = $dateTime;
        return $this->queryManager->insertInTable("Purciases", $data);
    }

    public function getOrders($cart) {
        return $this->queryManager->searchByAttribute("Orders", "CartId", $cart->id);
    }

    public function getOrderData($order) {
        return $this->queryManager->searchByAttribute("OrderData", "OrderId", $order["Id"]);
    }
}
