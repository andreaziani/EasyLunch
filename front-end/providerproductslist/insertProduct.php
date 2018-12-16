<?php 
    include ("product.php");
    include ("../utils/BaseController.php");
    include ("../utils/DBManager.php");
    
    session_start();

    $provider = $_SESSION["username"];

    if(isset($_FILES['image']) && isset($_POST["name"]) 
        && isset($_POST["description"]) && isset($_POST["price"])) { //check if all the variables are set.

        $db = new DBManager();
        $base = new BaseController();
        $filename = strtolower($_FILES['image']['name']); //Renaming the file here
        
        move_uploaded_file($_FILES['image']['tmp_name'], $base->getImagePath().$filename); // Move the uploaded file to the desired folder
        $product = new Product($_POST["name"], $_POST["description"], $base->getImagePath().$filename, $_POST["price"], $_POST["category"], $provider);
            
        $query = "INSERT INTO Products(Name, Description, Image, Price, IsActive, CategoryId, ProviderId) 
                  VALUES (" . "'" . $product->getName() . "', '" . $product->getDescription() . "', '" . $product->getImagePath() . "'," . 
                          $product->getPrice() . ", TRUE, " . $product->getCategory() .",'" . $product->getProvider() ."')";
        
        if($db->getConnection()->query($query) === TRUE){
            echo "Correctly inserted";
        } else{
            echo "Error: " . $db->getConnection()->error;
        }
    }
?>