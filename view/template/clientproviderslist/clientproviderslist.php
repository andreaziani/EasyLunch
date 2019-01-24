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
<script src="/ProgettoTecWeb/view/template/clientproviderslist/clientproviderslist.js"></script>
<link rel="stylesheet" href="/ProgettoTecWeb/view/template/clientproviderslist/style.css">
<section>
    <section>
        <div class="container">
            <div class="input-group" id="research">
                <label class='hidden' for="searchBar">Search bar</label>
                <input class="form-control" id="searchBar" type="text" placeholder="Search restaurant.." name="search" autocomplete="on">
                <div class="input-group-btn">
                    <button class="btn btn-default" id="searchButton"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h1> Restaurants </h1>
        <div id="providers">
            <ul id="providerlist">
                <?php
                    $query = "SELECT * FROM Providers ORDER BY CompanyName";
                    $result = $db->queryDataToList($db->executeQuery($query));
                    foreach($result as $row) {
                        $rate_query = "SELECT AVG(Rank) FROM ProvidersReviews WHERE ProviderId='" . $row["UserName"] . "'";
                        $rate = $db->queryDataToObject($db->executeQuery($rate_query));
                        if(is_null($rate["AVG(Rank)"])) $rate["AVG(Rank)"] = 0;
                        $listItem = "<li class='provider'> 
                                    <form action='/ProgettoTecWeb/view/template/clientproductslist/clientproductslist.php' method='POST'>
                                        <input class='hidden username' name='username' type='text' value='" . $row["UserName"] . "'/> 
                                        <h2 class='companyname'>" . $row["CompanyName"] . "</h2>";
                        for($i = 0; $i < 5; $i++){ //stars
                            if($i < $rate["AVG(Rank)"])
                                $listItem = $listItem . '<span class="fa fa-star orange-star"></span>';
                            else 
                                $listItem = $listItem . '<span class="fa fa-star"></span>';
                        }
                        $listItem = $listItem . "<span class='review'> <a> (Reviews) </a> </span>";
                        echo $listItem . "<p class='phonenumber'> Tel: " . $row["PhoneNumber"] . "</p>
                                        <p class='email'> Email: ". $row["Email"] . "</p>
                                        <p class='address'> Address: " . $row["AddressStreet"] . "  <span> " . $row["AddressNumber"] . "<span/></p>
                                    </form>
                                    </li>";
                    }
                ?>
            </ul>
        </div>
    </section>
</section>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>