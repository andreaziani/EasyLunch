<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="/ProgettoTecWeb/view/template/access/style.css">
<br/>
<?php
    if (isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger'>". $_SESSION["error"] ."</div> <br/>";
        unset($_SESSION["error"]);
    }
?>
<div class="container login-container login" id="access">
    <h1>Log in</h1>
    <form id="loginform" action="/ProgettoTecWeb/controller/action/login.php" method="POST">
        <div class="form-group user-psw">
            <label>Username: <input class="form-control input-sm" type="text" name="username" /></label><br/>
            <label>Password: <input class="form-control input-sm" type="password" name="password" /></label><br/>
        <div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary input-sm" value="Log in" id="submit"/>
        <div>
    </form>
</div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/access/access.js"></script>