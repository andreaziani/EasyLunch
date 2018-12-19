<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>

<a href="../registration/registration.html">Sign up</a>
<section id="access">
    <h1>Sign in!</h1>
    <form action="../../../controller/action/login.php" method="POST">
        <label>Username: <input type="text" name="username" /></label><br/>
        <label>Password: <input type="password" name="password" /></label><br/>
        <input type="submit" value="Sign in" id="submit"/>
    </form>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="access.js"></script>