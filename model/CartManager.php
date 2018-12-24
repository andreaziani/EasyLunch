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
        }
        return $order;
    }

    public function createCart($user) {
        $data["ClientId"] = $user->id;
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

    public function addProductToCart($cart, $entry) {
        $cart->addEntry($entry); //TODO order, need provider
        $this->queryManager->insertInTable("");
        //TODO return ok?
    }

}
