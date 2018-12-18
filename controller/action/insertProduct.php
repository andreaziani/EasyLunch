<?php 
include ("../../utils/pathManager.php");
include ("../../model/DBManager.php");
    
    session_start();

    $provider = $_SESSION["username"];

    if(isset($_FILES['image']) && isset($_POST["name"]) 
        && isset($_POST["description"]) && isset($_POST["price"])) { //check if all the variables are set.

        $db = new DBManager();
        $base = new PathManager();
        $filename = strtolower($_FILES['image']['name']); //Renaming the file here
        
        move_uploaded_file($_FILES['image']['tmp_name'], $base->getGlobalProductImagePath().$filename); // Move the uploaded file to the desired folder            
        $query = "INSERT INTO Products(Name, Description, Image, Price, IsActive, CategoryId, ProviderId) 
                  VALUES (" . "'" . $_POST["name"] . "', '" . $_POST["description"] . "', '" . $base->getLocalProductImagePath().$filename . "'," . 
                          $_POST["price"] . ", TRUE, " . $_POST["category"] .",'" . $provider ."')";
        $db->getConnection()->query($query);
        $db->closeConnection();
    }

    header("location: ../../view/template/providerproductlist/providerProductsList.php");
?>