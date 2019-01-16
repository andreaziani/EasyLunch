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

<section>
    <div id="providers">
        <h1> Restaurants </h1>
        <ul id="providerlist">
            <?php
                $query = "SELECT * FROM Providers ORDER BY CompanyName";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        echo "<li> 
                                <form action='/ProgettoTecWeb/view/template/clientproductslist/clientproductslist.php' method='POST'>
                                    <input class='hidden username' name='username' type='text' value='" . $row["UserName"] . "'/> 
                                    <h2 class='companyname'>" . $row["CompanyName"] . "</h2>
                                    <p class='phonenumber'> Tel: " . $row["PhoneNumber"] . "</p>
                                    <p class='email'> Email: ". $row["Email"] . "</p>
                                    <p class='address'> Address: " . $row["AddressStreet"] . "<span>" . $row["AddressNumber"] . "<span/></p>
                                </form>
                            </li>";
                }
            ?>
        </ul>
    </div>
    
</section>

<script src="/ProgettoTecWeb/view/template/clientproviderslist/clientproviderslist.js"></script>
<link rel="stylesheet" href="/ProgettoTecWeb/view/template/clientproviderslist/style.css">
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>