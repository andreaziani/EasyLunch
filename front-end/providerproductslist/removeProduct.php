<?php
    include ("../utils/BaseController.php");
    include ("../utils/DBManager.php");

    session_start();

    $provider = $_SESSION["username"];
    $db = new DBManager();

    $query = "DELETE FROM Products 
              WHERE Name='" . $_REQUEST["name"] . "' AND ProviderId='" . $provider . "'";

    if ($db->getConnection()->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo $db->getConnection()->error;
    }

    $db->closeConnection();
?>