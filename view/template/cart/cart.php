<section>
    <h1>Cart Summary</h1>
    <table>
        <tr>
            <th>Product</th>
            <th>Provider</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php
            session_start();
            $cart = $_SESSION["cart"];
            if ($cart != null and $cart)
        ?>

            <tr>
            <td>Product1</td>
            <td>Provider1</td>
            <td>x€</td>
            <td><input type="number" /></td>
        </tr><!---->
        <!--table rows will be created with text taken from db-->
    </table>
    <input type="submit" value="Submit" id="submit"/>
    <a href="../clientproductlist/productslist.html">Back</a>
    <input type="button" value="Cancel" id="cancel"/>
</section>
<script src="cart.js"></script>