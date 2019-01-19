<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
<section>
<?php
        if (isset($_SESSION["cart"])) {
            $html = 
                "<h1>Cart Summary</h1>" .
                "<table>" .
                    "<tr>" .
                        "<th>Product</th>" .
                        "<th>Price</th>" .
                        "<th>Quantity</th>" .
                    "</tr>";
            //<input type="button" value="Cancel" id="cancel"/>;
            //session_start();
            $cart = $_SESSION["cart"];
            //var_dump($cart);
            foreach ($cart->entries as $entry) {
                $html = $html . 
                    "<tr>" .
                        "<td>" . $entry->productName ."</td>" .
                        "<td>" . $entry->price ."</td>" .
                        "<td>" . $entry->quantity ."</td>" .
                    "</tr>";
            }
            $html = $html .
                "</table>" .
                "<a href='/ProgettoTecWeb/view/template/cart/checkoutOrderPage.php'>Checkout</a>";
            echo $html;
        } else {
            echo "<h1>Your cart is empty</h1>";
        }
?>
    <a href='/ProgettoTecWeb/view/template/clientproviderslist/clientproviderslist.php'>Back</a>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="cart.js"></script>