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
    <table id="notificationTable" style="display: none;">
        <tr>
            <th>Time</th>
            <th>Description</th>
        </tr>

        <?php
        /*
            if (isset($_SESSION["notifications"])) {
                $notifications = $_SESSION["notifications"];
                usort($notifications, "cmp");
                foreach ($notifications as $notification) {
                    echo 
                        "<tr>" .
                            "<td>" . $notification->timestamp ."</td>" .
                            "<td><pre>" . $notification->description ."</pre></td>";
                    if ($notification->typology == "REVIEW" && in_array($notification->orderId, $_SESSION["revieableOrders"])) {
                        echo "<input type='button' value='Review' onclick='tryReview($notification->orderId)'/>";
                    }
                    echo  "</tr>";
                }
                echo "";
            }
        */
        ?>
        <tr></tr>
    </table>
    <input type='button' value='Reset notifications' id="resetButton"/>
</section>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/notification/notification.js"></script>