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
        <div class='col-xs-12 form'>
            <h1>Checkout</h1>
            <div class="form-group">
                <form id="checkoutform" action="/ProgettoTecWeb/controller/action/checkoutOrder.php" method="POST">
                    <label>Nominative: <input type="text" name="nominative" class="form-control input-sm"/></label><br/>
                    <label>Select delivery time: <input type="text" name="deliveryTime" id="time" class="form-control input-sm"/></label><br/>
                    <label>Select delivery spot: 
                        <select name="deliverySpot" class="form-control input-small" style='min-width: 100%; width: 80px;'>
                            <option>Entrance_A</output> <!--TODO entrance names-->
                            <option>Entrance_B</output>
                        </select>
                    </label><br/>
                    <label>Select delivery date: <input type="date" name="deliveryDate" id="date" class="form-control input-sm" style='min-width: 100%; width: 80px;'/></label><br/>
                    <input type="submit" value="Submit" id="submit" class='btn btn-primary' />
                    <a href="/ProgettoTecWeb/view/template/cart/cartPage.php" class='btn btn-primary'>Back</a>
                </form>
            </div>
            
        </div>
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="cart.js"></script>