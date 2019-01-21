<?php 
// require and include all the files
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Utils\PathManager;

    $base = new PathManager();    
    $base->requireFromWebSitePath('header/_header.php');
?>
    <script src="/ProgettoTecWeb/view/index.js"></script>
    <link rel="stylesheet" href="/ProgettoTecWeb/view/indexStylesheet.css">
    <div class='jumbotron jumbotron-fluid text-center'>
        <div class="container index-text">
            <h1> The beauty is in taste </h1>
            <p> Choose your lunch among thousands of restaurants!</p>
            <?php 
                if(!isset($_SESSION["user"])){
                    echo "<button id='begin'> Begin now </button>";
                }
            ?>
        </div>
    </div>
    
    <div class="container-fluid .bg-grey text-center text-container howtoclient">
        <div class="row">
            <div class="col-sm-8">    
                <h2>Do you want to have lunch?</h2>
                    <p>Follow this simple steps:</p>
                    <ol>
                        <li> If you are not registered, please fill the ragistration page </li>
                        <li> Once you are registered, log into your personal account </li>
                        <li> Choose from thousands restaurants and make your choices </li>
                        <li> Once you have ordered, a notification will be sended to you when the lunch is ready </li>
                        <li> Remeber, the payment is at the spot! </li>
                        <li> Enjoy your lunch </li>
                    </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center text-container howtoprovider">
        <h2>Are you a restaurant?</h2>
        <p>Follow this simple steps:</p>
        <ol>
            <li> If you are not registered, please fill the ragistration page </li>
            <li> Once you are registered, log into your personal account </li>
            <li> Start creating your personal menu </li>
            <li> Once someone have ordered, EasyLunch will send to you a notification </li>
            <li> Remember, the delivery man comes to take the order 10 minutes before the delivery time </li>
        </ol>
        <!--maybe an icon is good-->
    </div>
  </div>
</div>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>