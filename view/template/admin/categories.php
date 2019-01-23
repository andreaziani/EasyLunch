<?php 

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Model\QueryManager;
use Utils\PathManager;

$db = new QueryManager();
$base = new PathManager();
$base->requireFromWebSitePath('header/_header.php');

?>

<?php
    if (isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger'>". $_SESSION["error"] ."</div> <br/>";
        unset($_SESSION["error"]);
    }
?>

<link rel="stylesheet" href="/ProgettoTecWeb/view/template/admin/style.css">
<section>
    <div class='container'>
        <div class='col-12 form'>
            <h1 class='display-4'>Categories</h1>
            <ul>
            <?php 
                $query = "SELECT Name FROM Categories";
                $result = $db->queryDataToList($db->executeQuery($query));
                foreach($result as $row) {
                    echo "<li >" . $row["Name"] . 
                    "<form class='category' action='/ProgettoTecWeb/controller/action/removeCategory.php' method='GET'><input name='name' type='text' class='hidden' value='". $row["Name"] . "'/><a><span class='glyphicon glyphicon-remove'</span> <span class='hidden'> Delete </span></a></form>
                    </li>";
                }
            ?>
            </ul>
            <div id='addnew'>
                <button class='btn btn-primary input-sm' type="button" name="addCathegory" id="addCathegory">Add cathegory</button>
            </div>
            <form class="hidden insert" action="/ProgettoTecWeb/controller/action/insertCategory.php" method="POST">
                <label>Name: <input class="form-control input-sm" type="text" name="name" /></label><br/>
                <input class='btn btn-primary input-sm' type="submit" name="saveCathegory" id="save" value="Save"/>
                <input class='btn btn-primary input-sm' type="button" name="cancel" id="cancel" value="cancel"/>
            </form>
        </div>
    </div>
</section>
    <script src="/ProgettoTecWeb/view/template/admin/categories.js"></script>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>