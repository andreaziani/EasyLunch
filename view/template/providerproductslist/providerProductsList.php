<link rel="stylesheet" href="style.css">
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
<section id="productlist">
            <h1>Your products</h1>
            <div>
                <ul>
                    <?php 
                        $query1 = "SELECT Id, Image, Name, Description, Price FROM Products WHERE ProviderId='" . $_SESSION["user"]->userName . "' AND IsActive=true";
                        $result = $db->queryDataToList($db->executeQuery($query1));
                        foreach($result as $row) {
                                echo "<li>" . 
                                        "<form action='/ProgettoTecWeb/controller/action/modifyProduct.php' method='GET'> " . 
                                            "<input type='number' value='". $row['Id'] . "' name='id' class='hidden', 'id' /><img src='../../../" . $row["Image"] . "' alt='Product' width=100/><br/>
                                            <label>Name: <input class='name' type='text' name='name' value='". $row["Name"] . "' disabled/></label><br/>
                                            <label for='description'>Description:</label><br/>
                                            <textarea name='description' class='description' cols='30' rows='5' disabled>" . $row["Description"] . "</textarea><br/>
                                            <label>Price in euro: <input type='text' name='price' value='". $row["Price"] . "' disabled/></label><br/>
                                            <button class='modify' type='button'>Modify</button>
                                            <button class='remove' type='button'>Remove</button>
                                            <button type='submit' class='saveModify'>Save product</button>
                                        </form>
                                </li>";
                        }
                    ?>
                </ul>
                <form class="hidden" action="/ProgettoTecWeb/controller/action/insertProduct.php" method="POST" enctype="multipart/form-data">
                    <label>Name: <input type="text" name="name" /></label><br/>
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea><br/>
                    <label>Add image: <input type="file" name="image" id="image"/></label><br/>
                    <label>Price in euro: <input type="text" name="price"/></label><br/>
                    <label for="category">Category: </label>
                    <select name="category" id="category"> 
                        <?php  
                            $query = "SELECT * FROM Categories";
                            $result = $db->queryDataToList($db->executeQuery($query));
                            foreach($result as $row) {
                                    echo '<option value="' . $row["Id"] . '">' . $row["Name"] . '</option>';
                            }
                            ?>
                    </select> <br/>
                    <button type="submit" class="saveProduct">Save product</button>
                    <button type="reset" class="cancel">Cancel</button>
                </form>
                <button type="button" id="addProduct">Add product</button>
            </div>
</section>
<script src="productslist.js"></script>

<?php 
    $base->requireFromWebSitePath('footer/_footer.php');
?>