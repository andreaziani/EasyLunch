<?php
    include ("../utils/BaseController.php");
    include ("../utils/DBManager.php");

    session_start();

    $provider = $_SESSION["username"];
    $db = new DBManager();

    $query = "UPDATE Products 
              SET Name='". $_GET["name"] . 
              "', Description='" . $_GET["description"] . 
              "', Price=" . $_GET["price"] .
              "  WHERE ProviderId='" . $provider . 
              "' AND Name='" . $_GET["name"] . "'";

    if ($db->getConnection()->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo $db->getConnection()->error;
    }
    $db->closeConnection();
    header("location: _providerProductsList.php");
?>
