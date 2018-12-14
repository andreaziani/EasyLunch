<?php 
include ("../utils/BaseController.php");
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
                <form class="hidden" action="" method="GET"> <!--Maybe it's ok to use get because they aren't sensitive data-->
                    <label>Name: <input type="text" name="name" /></label><br/>
                    <label for="description">Description:</label><br/>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea><br/>
                    <label>Add image: <input type="file" name="image" id="image"/></label><br/>
                    <label>Price in euro: <input type="text" name="price"/></label><br/>
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