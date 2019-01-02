<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
<section>
    <h1>Checkout</h1>
    <form id="checkoutform" action="/ProgettoTecWeb/controller/action/checkoutOrder.php" method="POST">
        <label>Nominative for order receipient: <input type="text" name="nominative" /></label><br/>
        <label>Select delivery spot: 
            <select name="deliverySpot">
                <option>Entrance_A</output> <!--TODO entrance names-->
                <option>Entrance_B</output>
            </select>
        </label><br/>
        <label>Select delivery date: <input type="date" name="deliveryDate" id="date" /></label><br/>
        <label>Select delivery time: <input type="text" name="deliveryTime" id="time" /></label><br/>
        <input type="submit" value="Submit" id="submit"/>
        <a href="/ProgettoTecWeb/view/template/cart/cartPage.php">Back</a>
    </form>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="cart.js"></script>