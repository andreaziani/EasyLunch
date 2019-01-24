<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>

<link rel="stylesheet" href="style.css">
<section>
    <div class='container'>
        <div class='col-xs-12 cart'>
<?php
        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"]->entries)) {
            $html = 
                "<h1>Cart Summary</h1>" .
                "<table class='table table-striped'>" .
                    "<caption>Your cart</caption>" .
                    "<thead>" .
                        "<tr>" .
                            "<th id='nameH'>Product</th>" .
                            "<th id='priceH'>Price</th>" .
                            "<th id='quantityH'>Quantity</th>" .
                            "<th id='removeH'>Remove</th>" .
                        "</tr>" .
                    "</thead>" .
                    "<tbody>";
            //<input type="button" value="Cancel" id="cancel"/>;
            //session_start();
            $cart = $_SESSION["cart"];
            //var_dump($cart);
            foreach ($cart->entries as $entry) {
                $html = $html . 
                    "<tr>" .
                        "<td headers='nameH'>" . $entry->productName ."</td>" .
                        "<td headers='priceH'>" . $entry->price ."</td>" .
                        "<td headers='quantityH'>" . $entry->quantity ."</td>" .
                        "<td headers='removeH'>" . "<button name='remove' id='btnRemove_" . $entry->productId . "' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button>" . "</td>" .
                    "</tr>";
            }
            $html = $html . "</tbody>" .
                "</table>" .
                "<a href='/ProgettoTecWeb/view/template/cart/checkoutOrderPage.php' class='btn btn-primary'>Checkout</a>";
            echo $html;
        } else {
            echo "<h1>Your cart is empty</h1>";
        }
?>
            <a href='/ProgettoTecWeb/view/template/clientproviderslist/clientproviderslist.php' class='btn btn-primary' style='float: right'>Back</a>
        </div>
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="cart.js"></script>