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
        $order = $this->queryManager->searchByDoubleKey("Carts", "CartId", $cart->id, "ProviderId", $providerId);
        if ($order == null) {
            $order = array();
            $order["CartId"] = $car->id;
            $order["ProviderId"] = $providerId;
            $this->queryManager->insertInTable("Orders", $order);
            $order = $this->queryManager->searchByDoubleKey("Carts", "CartId", $cart->id, "ProviderId", $providerId);
        }
        return $order;
    }

    public function createCart($user) {
        $data["ClientId"] = $user->userName;
        if ($this->queryManager->insertInTable("Carts", $data)) {
            //TODO maybe can be done better
            $cart = new Cart(end($this->queryManager->searchByAttribute("Carts", "Id", $id)));
            $user->currentCartId = $cart->id;
            $userData["CurrentCartId"] = $user->currentCartId;
            $this->queryManager->updateInTable("Users", $userData, "UserName", $user->userName);
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
        $providerId = $this->queryManager->searchByKey("Products", "Id", $entry->productId)["ProviderId"];
        $order = $this->findOrCreateOrder($cart, $providerId);
        $entryData["ProductId"] = $entry->productId;
        $entryData["Quantity"] = $entry->quantity;
        $entryData["Price"] = $entry->price;
        $entryData["OrderId"] = $order["Id"];
        return $this->queryManager->insertInTable("OrderEntries", $entryData);
    }

}
