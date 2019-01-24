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
<link rel="stylesheet" href="style.css">
<section id="productlist">
    <h1>Orders</h1>
    <!--checkbox hide done-->
    <div class='container-fluid'> 
        <div class='row'>
            <div class='col-xs-12'>
                <div class='table-responsive'>
                    <table class="table table-striped">
                        <caption>Your orders</caption>
                        <thead>
                            <tr>
                                <th id="statusH">Status</th>
                                <th id="detailsH">Details</th>
                                <th id="priceH">Total Price</th>
                                <th id="actionH">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            //TODO bug fix
                            function getRowClass($state) {
                                switch ($state) {
                                    case "COMPLETED":
                                        return "table-success";
                                    case "ARRIVED":
                                        return "table-primary";
                                    case "STARTED":
                                        return "table-secondary";
                                }
                            }

            $orderProvider = $_SESSION["orderProvider"];
            if ($orderProvider != null) {
                foreach ($orderProvider->getOrders($_SESSION["user"]) as $entry) {
                    echo 
                        "<tr class='" . getRowClass($entry["State"]) . "'>" .
                            "<td headers='statusH'>" . $entry["State"] ."</td>" .
                            "<td headers='detailsH'><button name='toggle_details' class='btn btn-info btn-sm'>Show details</button><br/><pre style='display: none;'><p style='font-size: 70%'>" . $entry["Description"] ."</p></pre></td>" .
                            "<td headers='priceH'>" . round($entry["TotalPrice"], 2) ."</td>";

                                    if ($_SESSION["user"]->type === "PROVIDER" && $entry["State"] === "STARTED") {
                                        echo "<td headers='actionH'><input type='button' value='SendOrder' onclick='trySend(" . $entry["Id"] . ")' class='btn btn-primary'/></td>";
                                    } else if ($_SESSION["user"]->type === "CLIENT" && $entry["State"] === "ARRIVED") {
                                        echo "<td headers='actionH'><input type='button' value='Review' onclick='tryReview(" . $entry["Id"] . ")' class='btn btn-primary'/></td>";
                                    } else {
                                        echo "<td headers='actionH'></td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="order.js"></script>