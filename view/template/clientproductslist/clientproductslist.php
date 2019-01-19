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
<link rel="stylesheet" href="/ProgettoTecWeb/view/template/clientproductslist/style.css">
<div class="container">
    <div class="input-group" id="research">
        <input class="form-control" id="searchBar" type="text" placeholder="Search.." name="search" results=5 autocomplete="on">
        <div class="input-group-btn">
            <button class="btn btn-default" id="searchButton"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
</div>

<div>
    <div>
        <!--TODO: CSS For images-->
    <ul id="productslist">
            <?php
                $query = "SELECT * FROM Products WHERE ProviderId='". $_POST["username"] ."' ORDER BY Name";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        echo "<li class='product'> 
                                <input class='hidden id' name='id' type='number' value='" . $row["Id"] . "'/> 
                                <h2 class='name'>" . $row["Name"] . "</h2>
                                <img class='productimg' src=/ProgettoTecWeb/" . $row["Image"] . " alt='Image of the product' />
                                <p class='description'>" . $row["Description"] . "</p>
                                <p class='price'> Price: <span class='value'>" . $row["Price"] . "</span> euro</p>
                                <div class='input-group'>
                                    <input class='form-control quantity' type='number' name='quantity' value='0'>
                                    <div class='input-group-btn'>
                                        <button class='btn btn-default addToCart'>Add to cart</button>
                                    </div>
                                 </div>
                              </li>";
                }
            ?>
                    </li>
                </ul>
            </div>
</section>
<script src="/ProgettoTecWeb/view/template/clientproductslist/productlist.js"></script>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>