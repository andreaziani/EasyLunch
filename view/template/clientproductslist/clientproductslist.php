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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section id="research">
        <input id="searchBar" type="text" placeholder="Search.." name="search" results=5 autocomplete="on">
        <button id="searchButton"><i class="fa fa-search"></i></button>

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
                                <input class='hidden id' name='id' type='number' value='" . $row["Id"] . "'/> 
                                <img src=/ProgettoTecWeb/" . $row["Image"] . " alt='Image of the product' width=70 />
                                <h2 class='name'>" . $row["Name"] . "</h2>
                                <p class='description'>" . $row["Description"] . "</p>
                                <p class='price'> Prezzo: " . $row["Price"] . " euro</p>
                                <input class='quantity' type='number' name='quantity' value='0'>
                                <button class='addToCart'>Add to cart</button>
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