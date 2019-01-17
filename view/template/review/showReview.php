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
<section>
        <ul id="reviews">
            <?php
                $query = "SELECT * FROM ProvidersReviews WHERE CompanyName='" . $_GET["companyname"] . "'";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        $html =  "<li>";
                        //TODO: Maybe there is another way to make stars
                        for($i=0; $i < $row["Rank"]; $i++){
                            $html = $html . "<span class='fa fa-star checked'></span>";
                        }
                        $html = "<p class='comment'>" . $row["Comment"] . "</p></li>";
                }
            ?>
        </ul>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>