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
        <div class='form'>
            <h1>Checkout</h1>
            <div class='row'>
                <div class='col-xs-6 col-sm-6 col-lg-6 col-xs-offset-3 col-sm-offset-3 col-lg-offset-3'>
                    <div class="form-group">
                        <form id="checkoutform" action="/ProgettoTecWeb/controller/action/checkoutOrder.php" method="POST">
                            <label for='nominative'>Nominative:</label><br/>
                            <input type="text" id='nominative' name="nominative" class="form-control input-sm"/><br/>
                            <label for='time'>Select delivery time:</label><br/>
                            <input type="text" name="deliveryTime" id="time" class="form-control input-sm"/><br/>
                            <label for='deliverySpot'>Select delivery spot: </label><br/>
                            <select id='deliverySpot' name="deliverySpot" class="form-control input-small">
                                    <option value='FIRST_FLOOR'>FIRST_FLOOR</output> <!--TODO entrance names-->
                                    <option value='SECOND_FLOOR'>SECOND_FLOOR</output>
                            </select><br/>
                            <label for='date'>Select delivery date:</label><br/>
                            <input type="date" name="deliveryDate" id="date" class="form-control input-sm"/><br/>
                            
                            <input type="submit" value="Submit" id="submit" class='btn btn-primary' />
                            <a href="/ProgettoTecWeb/view/template/cart/cartPage.php" class='btn btn-primary'>Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="cart.js"></script>