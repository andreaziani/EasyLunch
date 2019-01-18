<?php 
// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Utils\PathManager;

    $base = new PathManager();    
    $base->requireFromWebSitePath('header/_header.php');
?>

    <link rel="stylesheet" href="/ProgettoTecWeb/view/indexStylesheet.css">
    <div class='jumbotron jumbotron-fluid text-center'>
        <div class="container index-text">
            <h1> The beauty is in taste </h1>
            <p> Choose your lunch among thousands of restaurants!</p>
        </div>
    </div>

    <div class="container-fluid text-center text-container">
        <h2 id="mission">Our Mission</h2>
        <p id="mission-text">We strive to guarantee only the best restaurants with the highest quality dishes. All at your smartphone's reach!</p>
        <!--maybe an icon is good-->
    </div>
  </div>
</div>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>