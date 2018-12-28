<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>

<section>
    <h1>Notifications</h1>
    <table>
        <tr>
            <th>Time</th>
            <th>Description</th>
        </tr>
        <?php
            if (isset($_SESSION["notifications"])) {
                $notifications = $_SESSION["notifications"];
                usort($notifications, "cmp");
                foreach ($notifications as $notification) {
                    echo 
                        "<tr>" .
                            "<td>" . $notification->timestamp ."</td>" .
                            "<td>" . $notification->description ."</td>";
                    if ($notification->typology == "REVIEW") {
                        echo "<input type='button' value='Review'/>";//???
                    }
                    echo  "</tr>";
                }
            }
        ?>
        <tr></tr>
    </table>
</section>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="notifcation.js"></script>