<?php
namespace Controller\Action;

// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

$base = new PathManager();
$base->requireFromWebSitePath('header/_header.php');
?>

<section id="productlist">
    <h1>Orders</h1>
    <!--checkbox hide done-->
    <table>
        <tr>
            <th>Status</th>
            <th>Total Price</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
        <?php
            $orderProvider = $_SESSION["orderProvider"];
            if ($orderProvider != null) {
                foreach ($orderProvider->getOrders($_SESSION["user"]) as $entry) {
                    echo 
                        "<tr>" .
                            "<td>" . $entry["State"] ."</td>" .
                            "<td>" . $entry["TotalPrice"] ."</td>" .
                            "<td><pre>" . $entry["Description"] ."</pre></td>";

                    if ($_SESSION["user"]->type == "PROVIDER") {
                        echo "<td><input type='button' value='SendOrder' onclick='trySend(" . $entry["Id"] . ")'/></td>";
                    } else if ($_SESSION["user"]->type == "PROVIDER" && ($entry["State"] === "ARRIVED" || $entry["State"] === "COMPLETED")) {
                        echo "<td><input type='button' value='Review' onclick='tryReview(" . $entry["Id"] . ")'/></td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
            }
        ?>
    </table>
</section>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>