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
    <div>
        <!--TODO: CSS For images-->
    <ul id="productslist">
            <?php
                $query = "SELECT * FROM Products WHERE ProviderId='". $_POST["username"] ."' AND IsActive=true ORDER BY Name";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        echo "<li> 
                                <input class='hidden id' name='id' type='number' value='" . $row["Id"] . "'/> 
                                <img src=/ProgettoTecWeb/" . $row["Image"] . " alt='Image of the product' width=70 />
                                <h2 class='name'>" . $row["Name"] . "</h2>
                                <p class='description'>" . $row["Description"] . "</p>
                                <p class='price'> Prezzo: <span class='value'>" . $row["Price"] . "</span> euro</p>
                                <input class='quantity' type='number' name='quantity' value='0'>
                                <button class='addToCart'>Add to cart</button>
                              </li>";
                }
            ?>
                    </li>
                </ul>
            </div>
</section>
<script src="/ProgettoTecWeb/view/template/clientproductslist/productlist.js"></script>
<link rel="stylesheet" href="/ProgettoTecWeb/view/template/clientproductslist/style.css">
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>