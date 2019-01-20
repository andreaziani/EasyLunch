<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');

    
    function cmp($a, $b) {
        return strtotime($b->timestamp) - strtotime($a->timestamp);
    }
?>

<section>
    <h1>Notifications</h1>
    <p id="noNotificationMessage">There are currently no unread notifications</p>
    <p id="notificationMessage">There are notifications unread, visit <a href="/ProgettoTecWeb/view/template/orders/orderPage.php">My Orders</a> to see what you can do</p>
    <table id="notificationTable" style="display: none;">
        <tr>
            <th>Time</th>
            <th>Description</th>
        </tr>
    </table>
    <input type='button' value='Reset notifications' id="resetButton"/>
</section>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/notification/notification.js"></script>