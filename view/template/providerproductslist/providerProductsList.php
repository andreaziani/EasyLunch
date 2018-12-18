<?php 
include ("../../../utils/pathManager.php");
include ("../../../model/DBManager.php");

    session_start();
    $_SESSION["username"] = "provider1";
    $db = new DBManager();
    $base = new PathManager();
    $base->requireFromWebSitePath('header/_providerheader.php');
?>

<link rel="stylesheet" href="style.css">
<section id="productlist">
            <h1>Your products</h1>
            <div>
                <ul>
                    <?php 
                        $query1 = "SELECT Image, Name, Description, Price FROM Products WHERE ProviderId='" . $_SESSION["username"] . "'";
                        $result1 = $db->getConnection()->query($query1);
                        if ($result1->num_rows > 0) {
                            while($row = $result1->fetch_assoc()) {
                                echo "<li>" . 
                                            "<form action='../../../controller/action/modifyProduct.php' method='GET'> " . 
                                                "<img src='../../../" . $row["Image"] . "' alt='Product' width=100/><br/>
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
                        }
                    ?>
                </ul>
                <form class="hidden" action="../../../controller/action/insertProduct.php" method="POST" enctype="multipart/form-data">
                    <label>Name: <input type="text" name="name" /></label><br/>
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea><br/>
                    <label>Add image: <input type="file" name="image" id="image"/></label><br/>
                    <label>Price in euro: <input type="text" name="price"/></label><br/>
                    <label for="category">Category: </label>
                    <select name="category" id="category"> 
                        <?php  
                            $query = "SELECT * FROM Categories";
                            $result = $db->getConnection()->query($query);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["Id"] . '">' . $row["Name"] . '</option>';
                                }
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