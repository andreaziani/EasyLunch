<?php
// require and include all the files
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Model\QueryManager;
use Utils\PathManager;

$db = new QueryManager();
$base = new PathManager();
$base->requireFromWebSitePath('header/_header.php');
?>

<section id="research">
    <input id="searchBar" type="search" name="search" results=5 autocomplete="on"><br/>
</section>

<section id="productlist">
    <a href="reviews.html"><img src="/ProgettoTecWeb/images/icons/customer-review.png" alt="Show reviews" width="70"></a><br/>
    <div>
        <!--TODO: CSS For images-->
    <ul id="productslist">
            <?php
                $query = "SELECT * FROM Products ORDER BY Name";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        echo "<li> 
                                <input class='hidden' name='id' type='number' value='" . $row["Id"] . "'/> 
                                <img src=../../.." . $row["Image"] . " alt='Image of the product' width=70 />
                                <h2>" . $row["Name"] . "</h2>
                                <p class='description'>" . $row["Description"] . "</p>
                                <p class='price'> Prezzo: " . $row["Price"] . " euro</p>
                                <input type='number' name='quantity' value='0'>
                                <button>Add to cart</button>
                              </li>";
                }
            ?>
                    </li>
                </ul>
            </div>
</section>
<script src="productlist.js"></script>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>