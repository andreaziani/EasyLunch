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
    <link rel="stylesheet" href="/ProgettoTecWeb/view/template/admin/style.css">
    <div>
        <h1>Current cathegories</h1>
        <ul>
        <?php 
            $query = "SELECT Name FROM Categories";
            $result = $db->queryDataToList($db->executeQuery($query));
            foreach($result as $row) {
                echo "<li>" . $row["Name"] . 
                "<input name='name' type='text' class='hidden' value='". $row["Name"] . "'/> <a class='remove'><img src='/ProgettoTecWeb/images/icons/delete.png' alt='modify' width='15'></a>
                </li>";
            }
        ?>
        </ul>
    </div>
    <div>
        <button type="button" name="addCathegory" id="addCathegory">Add cathegory</button>
        <form class="hidden insert" action="/ProgettoTecWeb/controller/action/insertCategory.php" method="POST">
            <label>Name: <input type="text" name="name" /></label><br/>
            <input type="submit" name="saveCathegory" id="save" value="Save"/>
            <input type="button" name="cancel" id="cancel" value="cancel"/>
        </form>
    </div>
    <script src="/ProgettoTecWeb/view/template/admin/categories.js"></script>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>