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
<link rel="stylesheet" href="showreview.css">
<section>
    <?php echo "<h1> Reviews about " . $_GET["companyname"]  . "</h1>";
    ?>
        <ul id="reviews">
            <?php
                $query = "SELECT * FROM ProvidersReviews WHERE CompanyName='" . $_GET["companyname"] . "'";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                        $html =  "<li class='review'>";
                        for($i = 0; $i < 5; $i++){ //stars
                            if($i < $row["Rank"])
                                $html = $html . '<span class="fa fa-star is-active"></span>';
                            else 
                                $html = $html . '<span class="fa fa-star"></span>';
                        }
                        $html = $html . "<p class='comment'>User said: " . $row["Comment"] . "</p> </li>";
                        echo $html;
                }
            ?>
        </ul>
    </div>
</div>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>