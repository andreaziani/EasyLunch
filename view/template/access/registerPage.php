<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');

    if (isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger'><strong>INVALID REGISTRATION:</strong> ". $_SESSION["error"] ."</div>";
        unset($_SESSION["error"]);
    }
?>

<link rel="stylesheet" href="/ProgettoTecWeb/view/template/access/style.css">
<div class="container login-container registration" id="registration">
    <h1>Registration</h1>
    <form id="registerform" action="../../../controller/action/register.php" method="POST">
        <div class="form-group user-psw">
            <label>Name: <input class="form-control input-sm" type="text" name="name" id="name" /></label><br/>
            <label>Surname: <input class="form-control input-sm" type="text" name="surname" id="surname" /></label><br/>
            <label>Birthdate: <input class="form-control input-sm" type="date" name="birthdate" id="birthdate" /></label><br/>
            <label>Telephone: <input class="form-control input-sm" type="tel" name="telephone" id="telephone" /></label><br/>
            <label>Email: <input class="form-control input-sm" type="email" name="email" id="email" /></label><br/>
        </div>  
        <div class="form-group user-psw">
            <label>Username: <input class="form-control input-sm" type="text" name="username" id="username" /></label><br/>
            <label>Password: <input class="form-control input-sm" type="password" name="password" id="password" /></label><br/>
            <label>Repeat Password: <input class="form-control input-sm" type="password" name="rpassword" id="rPassword" /></label><br/>
        </div>

        <div class="form-group user-psw">
                <label>
                Are you a provider or a client?: 
                <select class="form-control input-sm" name="typology" id="typology">
                    <option class="input-sm" value="client">Client</option>
                    <option class="input-sm" value="provider">Provider</option>
                </select>
            </label><br/>
            <fieldset id="providerFields" style="display: none; border: 0px">
                <label>Company name: <input class="form-control input-sm" type="text" name="companyName" id="companyName" /></label><br/>
                <label>PIVA:  <input class="form-control input-sm" type="text" name="piva" id="piva" /></label><br/>    
                <label>City:  <input class="form-control input-sm" type="text" name="cityAddress" id="cityAddress" /></label><br/>
                <label>Street:  <input class="form-control input-sm" type="text" name="addressStreet" id="addressStreet" /></label><br/>
                <label>Street Number:  <input class="form-control input-sm" type="text" name="addressNumber" id="addressNumber" /></label><br/>
            </fieldset>
        </div>
        <input class="btn btn-primary" type="submit" value="Sign up" id="submit"/>
        <input class="btn btn-primary" type="reset" value="Reset" />
    </form>
</section>
<script src="/ProgettoTecWeb/view/template/access/access.js"></script>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>