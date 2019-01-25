<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="style.css">
<section id='policy'>
    <div class='container'>
        <h1>Easy lunch Cookie Policy</h1>
        <p> We use cookies to improve the quality of our site and service, and to try and make your browsing experience meaningful. 
            When you enter our site our web server sends a cookie to your computer which allows us to recognise your computer but not specifically who is using it. 
            By associating the identification numbers in the cookies with other customer information when for example you log-in to the site, then we know that the cookie information relates to you.
            By proceeding beyond this page you consent to our cookie settings and agree that you understand this Cookies Policy which explains how you can manage your cookie choices and preferences.
        <p>

        <h2> Why do we use cookies? </h2>
        <p> The cookies used on Easylunch are explained below and based on the International Chamber of Commerce guide for cookie categories.<p>
        <h3> Strictly necessary cookies</h3>
        <p>Strictly necessary cookies allow you to use essential features of our site such as enabling you to order takeaway more easily.
        We are able to identify you as being logged in to EasyLunch and to ensure that you are able to access the appropriate features on our site.
        </p>
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>