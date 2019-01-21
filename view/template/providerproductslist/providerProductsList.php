<?php 
    // require and include all the files
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php')){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/vendor/autoload.php';
    }
    
    use Model\QueryManager;
    use Utils\PathManager;
    $db = new QueryManager();
    $base = new PathManager();
    $base->requireFromWebSitePath('header/_header.php');
?>

<link rel="stylesheet" href="style.css">
<div id="productlist">
            <h1>Your products</h1>
            <div>
                <ul id="productslist">
                    <?php 
                        $query1 = "SELECT Id, Image, Name, Description, Price FROM Products WHERE ProviderId='" . $_SESSION["user"]->userName . "' AND IsActive=true";
                        $result = $db->queryDataToList($db->executeQuery($query1));
                        foreach($result as $row) {
                                echo "<li class='product'>" . 
                                        "<form action='/ProgettoTecWeb/controller/action/modifyProduct.php' method='GET'> " . 
                                            "<input type='number' value='". $row['Id'] . "' name='id' class='hidden', 'id' /><img class='productimg' src='/ProgettoTecWeb/" . $row["Image"] . "' alt='Product image'/><br/>
                                            <label>Name: <input class='form-control input-sm name' type='text' name='name' value='". $row["Name"] . "' disabled/></label><br/>
                                            <label for='description'>Description:</label><br/>
                                            <textarea class='form-control input-sm description' name='description' cols='30' rows='5' disabled>" . $row["Description"] . "</textarea><br/>
                                            <label>Price in euro: <input class='form-control input-sm' type='text' name='price' value='". $row["Price"] . "' disabled/></label><br/>
                                            <button class='btn btn-primary input-sm modify' type='button'>Modify</button>
                                            <button class='btn btn-primary input-sm remove' type='button'>Remove</button>
                                            <button type='submit' class='btn btn-primary input-sm saveModify'>Save product</button>
                                        </form>
                                </li>";
                        }
                    ?>
                </ul>
                
                <ul class="newProduct hidden">
                    <li class='new'>
                        <h2> New Product </h2>
                        <form class='newP' action="/ProgettoTecWeb/controller/action/insertProduct.php" method="POST" enctype="multipart/form-data">
                            <label>Name: <input class='form-control input-sm' type="text" name="name" /></label><br/>
                            <label for="description">Description:</label><br/>
                            <textarea class='form-control input-sm' name="description" id="description" cols="30" rows="5"></textarea><br/>
                            <label>Add image: <input class='form-control input-sm' type="file" name="image" id="image"/></label><br/>
                            <label>Price in euro: <input class='form-control input-sm' type="text" name="price"/></label><br/>
                            <label for="category">Category: </label>
                            <select class='form-control input-sm' name="category" id="category"> 
                                <?php  
                                    $query = "SELECT * FROM Categories";
                                    $result = $db->queryDataToList($db->executeQuery($query));
                                    foreach($result as $row) {
                                            echo '<option value="' . $row["Id"] . '">' . $row["Name"] . '</option>';
                                    }
                                    ?>
                            </select> <br/>
                            <button type="submit" class='btn btn-primary input-sm saveProduct'>Save product</button>
                            <button type="reset" class='btn btn-primary input-sm cancel'>Cancel</button>
                        </form>
                    </li>
                </ul>
                <div class='productinseriment'>
                    <button class='btn btn-primary input-sm' type="button" id="addProduct">Add new product</button>
                <div>
            </div>
</div>
<script src="productslist.js"></script>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>