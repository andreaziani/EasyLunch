<?php 
include ("../../../utils/pathManager.php");
    $base = new PathManager();    
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="style.css">
<div>
    <img src="../resources/user.png" alt="Personal profile" width="70">
    <fieldset id="personalinfo">
        <legend>Personal informations</legend>
        <!--Span will be filled with text taken from db-->
        <form action="" method="POST">
            <!--TODO: Set img size with css-->
            <!--Each modifiable field should be validate-->
            <label>Name: <input type="text" name="name" id="name" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />
                   
            <label>Surname: <input type="text" name="surname" id="surname" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />

            <label>Password: <input type="password" name="password" id="password" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />
                
            <label>Birthdate: <input type="date" name="birthdate" id="birthdate" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />
                
            <label>Telephone: <input type="tel" name="telephone" id="telephone" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />
                
            <label>Email: <input type="email" name="email" id="email" disabled /></label>
            <a class="edit"><img src="../resources/edit.png" alt="modify" width="15"></a><br />

            <button type="submit" id="saveChanges" class="hiddenButton">Save changes</button>
        </form>
    </fieldset>
</div>
<script src="editProfile.js"></script>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>