// @flow
$(function() {
  function isJson(str) {
    try {
      JSON.parse(str);
    } catch (e) {
      return false;
    }
    return true;
  }

  function search() {
    var key = $("#searchBar").val();
    $.get(
      "/ProgettoTecWeb/controller/action/searchProducts.php",
      { key: key },
      function(data) {
        if (isJson(data)) {
          var obj = JSON.parse(data);
          var html = "";
          for (var i = 0; i < obj.length; i++) {
            html =
              html +
              "<li class='product'> <input class='hidden id' name='id' type='number' value='" +
              obj[i].Id +
              "' /><h2 class='name'>" +
              obj[i].Name +
              "</h2> <img class='productimg' src=/ProgettoTecWeb/" +
              obj[i].Image +
              " alt='Image of the product' /><p class='description'>" +
              obj[i].Description +
              "<p class='price'> Price: <span class='value'>" + obj[i].Price + "</span> euro</p> " +
              "<div class='input-group'><input type='number' class='form-control quantity' name='quantity' value='0'><div class='input-group-btn'><button class='btn btn-default addToCart'>Add to cart</button> </div></div></li> ";
          }
          $("#productslist").html(html);
        }
      }
    );
    $("#searchBar").val(""); //clear the search bar
  }
  //Search the product written by the user
  function searchWithKeyPress(e) {
    if (e.which == 13) {
      // if the key is "Enter"
      search();
    }
  }

  function addToCart(){
    var id = $(this).parent().parent().siblings(".id").val();
    var name = $(this).parent().parent().siblings(".name").html();
    var price = $(this).parent().parent().siblings(".price").children(".value").html();
    var li = $(this).parent().parent().parent();
    //console.log(id + " "+ price + " " + name);
    var quantity = $(this).parent().siblings(".quantity").val();
    if(quantity > 0){
      $.get("/ProgettoTecWeb/controller/action/addProductToCart.php", {id: id, quantity: quantity, name: name, price: price}, function(data) {
        var html = "<div class='alert alert-success'>" + data + "</div> <br/>";
        li.append(html);
      });
    }
  }

  $("#searchBar").keypress(searchWithKeyPress);
  $("#searchButton").click(search);
  $("#productslist").on('click',".addToCart",addToCart);
  $("#productslist").on('focusin', ".quantity", function(){
    setTimeout(function(){
      $(".alert-success").fadeOut();
    }, 1000);
  })
});
