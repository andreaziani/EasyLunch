// @flow
$(function () {
    //Search the product written by the user
    function search(e) { 
        if(e.which == 13) { // if the key is "Enter"
            var key = $(this).val();
            $.get("/ProgettoTecWeb/controller/action/searchProducts.php", {key: key}, 
                function (data) {
                    var obj = JSON.parse(data);
                    var html = "";
                    for(var i = 0; i < obj.length; i++){
                        html = html + "<li> <input class='hidden' name='id' type='number' value='" + obj[i].Id +  "'/> <img src=/ProgettoTecWeb/" + obj[i].Image + " alt='Image of the product' width=70 /><h2>" + obj[i].Name + "</h2><p class='description'>" + obj[i].Description + "</p><p class='price'> Prezzo: " + obj[i].Price + " euro</p><input type='number' name='quantity' value='0'><button>Add to cart</button> </li> ";
                    }
                    $('#productslist').html(html);         
            });
            $(this).val(" ");//clear the search bar
        }
    }
    $("#searchBar").keypress(search);
 })