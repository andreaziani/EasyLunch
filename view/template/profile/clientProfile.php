<?php 
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
}

use Utils\PathManager;
    $base = new PathManager();    
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="style.css">
<div>
    <img src="/ProgettoTecWeb/images/icons/user.png" alt="Personal profile" width="70">
    <fieldset id="personalinfo">
        <legend>Personal informations</legend>
        <!--Span will be filled with text taken from db-->
        <form id="profileInformations" action="" method="POST">
            <?php 
                echo "<label>Name: <input type='text' name='name' id='name' value='" . $_SESSION["user"]->name .
                "' disabled /></label>" .
                " <a class='edit'><img src='/ProgettoTecWeb/images/icons/edit.png' alt='modify' width='15'></a><br />" .
                " <label>Surname: <input type='text' name='surname' id='surname' value='" .
                $_SESSION["user"]->surname .
                "' disabled /></label>" .
                " <a class='edit'><img src='/ProgettoTecWeb/images/icons/edit.png' alt='modify' width='15'></a><br />" .
                " <label>Birthdate: <input type='text' name='surname' id='surname' value='" .
                $_SESSION["user"]->birthdate .
                "' disabled /></label>" .
                " <a class='edit'><img src='/ProgettoTecWeb/images/icons/edit.png' alt='modify' width='15'></a><br />" .
                " <label>Telephone: <input type='text' name='surname' id='surname' value='" .
                $_SESSION["user"]->phoneNumber .
                "' disabled /></label>" .
                " <a class='edit'><img src='/ProgettoTecWeb/images/icons/edit.png' alt='modify' width='15'></a><br />" .
                " <label>Email: <input type='text' name='surname' id='surname' value='" .
                $_SESSION["user"]->email .
                "' disabled /></label>" .
                " <a class='edit'><img src='/ProgettoTecWeb/images/icons/edit.png' alt='modify' width='15'></a><br />" .
                " <button type='submit' id='saveChanges' class='hiddenButton'>Save changes</button>"
            ?>
        </form>
    </fieldset>
</div>
<script src="editProfile.js"></script>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>