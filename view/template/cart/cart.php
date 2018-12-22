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
            if ($cart != null) {
                foreach ($cart->entries as $entry) {
                    echo 
                        "<tr>" .
                            "<td>" . $entry->productName ."</td>" .
                            //"<td>" . $entry->provider ."</td>" .
                            "<td>" . $entry->price ."</td>" .
                            "<td>" . $entry->quantity ."</td>" .
                        "</tr>";
                }
            }
        ?>
    </table>
    <input type="submit" value="Submit" id="submit"/>
    <a href="ProgettoTecWeb/view/template/clientproductlist/clientproductlist.php">Back</a>
    <input type="button" value="Cancel" id="cancel"/>
</section>
<script src="cart.js"></script>