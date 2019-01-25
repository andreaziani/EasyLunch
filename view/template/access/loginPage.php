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
<section>
    <div class="container login-container login" id="access">
        <h1>Log in</h1>
        <div class='row'>
            <div class='col-xs-6 col-2 col-xs-offset-3 col-offset-3'>
                <form id="loginform" action="/ProgettoTecWeb/controller/action/login.php" method="POST">
                    <div class="form-group user-psw">
                        <label for='username'>Username:</label><br/>
                        <input class="form-control input-sm" type="text" name="username" id='username'/>
                        <br/>
                        <label for='password'>Password:</label><br/>
                        <input class="form-control input-sm" type="password" name="password" id='password'/><br/>
                    <div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary input-sm" value="Log in" id="submit"/>
                    <div>
                </form>
                <br/>
                <p>Are you not registered? <a href="/ProgettoTecWeb/view/template/access/registerPage.php">Register now</a></p>
            </div>
        </div>
    </div>
</section>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>

<script src="/ProgettoTecWeb/view/template/access/access.js"></script>