<?php 
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Utils\PathManager;

    $base = new PathManager();    
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="style.css">
<section>
    <div class='container'>
        <div class='col-12 form'>
                <h1 class='display-4'>Personal informations</h1>
                
                <div class="form-group">
                <form id="profileInformations" action="/ProgettoTecWeb/controller/action/modifyProfile.php" method="POST">
                <?php 
                    echo "<label>Name: <input class='form-control input-sm' type='text' name='Name' id='name' value='" . $_SESSION["user"]->name .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Surname: <input class='form-control input-sm' type='text' name='Surname' id='surname' value='" .
                    $_SESSION["user"]->surname .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Birthdate: <input class='form-control input-sm' type='text' name='Birthdate' id='birthdate' value='" .
                    $_SESSION["user"]->birthdate .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Telephone: <input class='form-control input-sm' type='text' name='PhoneNumber' id='phone' value='" .
                    $_SESSION["user"]->phoneNumber .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Email: <input class='form-control input-sm' type='text' name='Email' id='email' value='" .
                    $_SESSION["user"]->email .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>PIVA: <input class='form-control input-sm' type='text' name='IVA' id='piva' value='" .
                    $_SESSION["user"]->iva . 
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>City: <input class='form-control input-sm' type='text' name='CityAddress' id='city' value='" .
                    $_SESSION["user"]->city . 
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Street: <input class='form-control input-sm' type='text' name='AddressStreet' id='street' value='" .
                    $_SESSION["user"]->street .
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" .
                    " <label>Number: <input class='form-control input-sm' type='text' name='AddressNumber' id='number' value='" .
                    $_SESSION["user"]->number . 
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" . 
                    " <label>Company: <input class='form-control input-sm' type='text' name='CompanyName' id='company' value='" .
                    $_SESSION["user"]->companyName . 
                    "' disabled /></label>" .
                    " <a class='edit'> <span class='glyphicon glyphicon-pencil'></span> <span class='hidden'>Modify</span></a><br />" . 
                    " <button type='submit' id='saveChanges' class='btn btn-primary input-sm hiddenButton'>Save changes</button>";
                ?>
            </form>
            </div>
        </div>
    </div>
</section>
<script src="editProfile.js"></script>
<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>