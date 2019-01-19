<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
    <h1>Confirm the sending of the order</h1>
    <form id="sendform" action="/ProgettoTecWeb/controller/action/sendOrder.php" method="POST">
        <label>expected minutes to arrive: <input type="number" name="minutes" /></label><br/>
        <input type="submit" value="Send" id="submit"/>
    </form>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/sendorder/sendOrder.js"></script>