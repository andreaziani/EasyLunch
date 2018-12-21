<?php
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}
use Utils\PathManager;

    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>

<a href="loginPage.php">Sign in</a>
<section id="registration">
    <h1>Register</h1>
    <form id="registerform" action="../../../controller/action/register.php" method="POST">
        <label>Name: <input type="text" name="name" id="name" /></label><br/>
        <label>Surname: <input type="text" name="surname" id="surname" /></label><br/>
        <label>Birthdate: <input type="date" name="birthdate" id="birthdate" /></label><br/>
        <label>Telephone: <input type="tel" name="telephone" id="telephone" /></label><br/>
        <label>Email: <input type="email" name="email" id="email" /></label><br/>
        <label>Username: <input type="text" name="username" id="username" /></label><br/>
        <label>Password: <input type="password" name="password" id="password" /></label><br/>
        <label>Repeat Password: <input type="password" name="rpassword" id="rPassword" /></label><br/>
        <label>
            Are you a provider or a client?: 
            <select name="typology" id="typology">
                <option value="client">Client</option>
                <option value="provider">Provider</option>
            </select>
        </label><br/>
        <fieldset id="providerFields" style="display: none; border: 0px">
            <label>PIVA:  <input type="text" name="piva" id="piva" /></label><br/>    
            <label>City:  <input type="text" name="cityAddress" id="cityAddress" /></label><br/>
            <label>Street:  <input type="text" name="addressStreet" id="addressStreet" /></label><br/>
            <label>Street Number:  <input type="text" name="addressNumber" id="addressNumber" /></label><br/>
        </fieldset>

        <input type="submit" value="Sign up" id="submit"/>
        <input type="reset" value="Reset" />
    </form>
</section>
<script src="access.js"></script>

<?php
    $base->requireFromWebSitePath('footer/_footer.php');
?>