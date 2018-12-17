<?php
include ("../../../utils/pathManager.php");

    if(isset($_POST['username']) && isset($_POST['password'])) { 
        $manager = new QueryManager();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = new DBManager();
        $base = new BaseController();

        $search_query = "SELECT UserName, Password FROM Users WHERE UserName = '" . $username . "'";
        $user = $manager.queryDataToObject($db->getConnection()->query($search_query));
        if ($user != null and password_verify($password, $user["Password"])) {
            session_start();
            $_SESSION["username"] = $username;
        }
    }
?>