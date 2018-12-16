<?php 
include ("../utils/BaseController.php");
include ("../utils/DBManager.php");

    session_start();
    $_SESSION["username"] = "provider1";
    $db = new DBManager();
    $base = new BaseController();
    $base->requireFromWebSitePath('header/_header.php');
?>
<link rel="stylesheet" href="style.css">
<section id="productlist">
            <h1>Your products</h1>
            <div>
                <ul>
                    <li>
                        <form action="" method="GET">
                            <figure>
                                <img src="../resources/food.png" alt="Image of the product" width="100"><br/>
                            </figure>
                            <label>Name: <input type="text" name="name" disabled/></label><br/>
                            <label for="description">Description:</label><br/>
                            <textarea name="description" id="description" cols="30" rows="5" disabled></textarea><br/>
                            <label>Price in euro: <input type="text" name="price" disabled/></label><br/>
                            <button class="modify" type="button">Modify</button>
                            <button class="remove" type="button">Remove</button>
                            <button type="submit" class="saveModify">Save product</button>
                        </form>
                    </li>
                </ul>
                <form class="hidden" action="insertProduct.php" method="POST" enctype="multipart/form-data">
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
                                    echo '<option value="' . $row['Id'] . '">' . $row['Name'] . '</option>';
                                }
                            } else {
                                echo "<option value='null'>----------</option>";
                            }
                            $db->closeConnection();
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