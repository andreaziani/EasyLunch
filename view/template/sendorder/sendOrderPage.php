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
            <h1>Confirm the sending of the order</h1>
            <p>You will notify the client that his order is coming, please indicate how much time he will need to wait from now</p>
            <div class="form-group">
                <form id="sendform" action="/ProgettoTecWeb/controller/action/sendOrder.php" method="POST">
                    <label>expected minutes to arrive: <input type="number" min='0' name="minutes" class='form-control'/></label><br/>
                    <input type="submit" value="Send" id="submit" class='btn btn-primary'/>
                    <a href="../orders/orderPage.php" class='btn btn-primary'>Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/sendorder/sendOrder.js"></script>