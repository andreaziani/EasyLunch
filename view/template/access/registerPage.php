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

<link rel="stylesheet" href="style.css">
<section>
    <div class="container login-container registration" id="registration">
        <h1>Registration</h1>
        <div class='row'>
            <div class='col-xs-6 col-xs-offset-3'>
                <form id="registerform" action="../../../controller/action/register.php" method="POST">
                    <div class="form-group user-psw">
                        <label for='name'>Name:</label><br/><input class="form-control input-sm" type="text" name="name" id="name" /><br/>
                        <label for='surname'>Surname: </label><br/><input class="form-control input-sm" type="text" name="surname" id="surname" /><br/>
                        <label for='birthdate'>Birthdate:</label><br/><input class="form-control input-sm" type="date" name="birthdate" id="birthdate"/><br/>
                        <label for='telephone'>Telephone:</label><br/><input class="form-control input-sm" type="tel" name="telephone" id="telephone" /><br/>
                        <label for='email'>Email: </label><br/><input class="form-control input-sm" type="email" name="email" id="email" /><br/>
                    </div>  
                    <div class="form-group user-psw">
                        <label for='username'>Username: </label><br/><input class="form-control input-sm" type="text" name="username" id="username" /><br/>
                        <label for='password'>Password: </label><br/><input class="form-control input-sm" type="password" name="password" id="password" /><br/>
                        <label for='rPassword'>Repeat Password: </label><br/><input class="form-control input-sm" type="password" name="rpassword" id="rPassword" /><br/>
                    </div>
                    <div class="form-group user-psw">
                                <label for='typology'> Register as: </label>
                                <select class="form-control" name="typology" id="typology">
                                    <option class="input-sm" value="client">Client</option>
                                    <option class="input-sm" value="provider">Provider</option>
                                </select>
                            <br/>
                        <fieldset id="providerFields" style="display: none; border: 0px">
                            <label for='companyName'>Company name: </label><br/><input class="form-control input-sm" type="text" name="companyName" id="companyName" /><br/>
                            <label for='piva'>PIVA: </label><br/> <input class="form-control input-sm" type="text" name="piva" id="piva" /><br/>
                            <label for='cityAddress'>City: </label><br/><input class="form-control input-sm" type="text" name="cityAddress" id="cityAddress" /><br/>
                            <label for='addressStreet'>Street: </label><br/><input class="form-control input-sm" type="text" name="addressStreet" id="addressStreet" /><br/>
                            <label for='addressNumber'>Street Number: </label><br/><input class="form-control input-sm" type="text" name="addressNumber" id="addressNumber" /><br/>
                        </fieldset>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Sign up" id="submit"/>
                    <input class="btn btn-primary" type="reset" value="Reset" />
                </form>
            </div>
        </div>
    </div>
</section>
<script src="/ProgettoTecWeb/view/template/access/access.js"></script>
<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>