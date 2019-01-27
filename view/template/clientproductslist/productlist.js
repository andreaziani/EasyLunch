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
    var provider = $("#provider").val();
    $.get(
      "/ProgettoTecWeb/controller/action/searchProducts.php",
      { key: key, provider: provider },
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
              " alt='" +
              obj[i].Description +
              "' /> <p class='description'>" +
              obj[i].Description +
              "<p class='price'> Price:  €  <span class='value'>" +
              obj[i].Price +
              "</span> </p> " +
              "<div class='row'><div class='input-group buttons col-xs-3 col-2 col-xs-offset-3 col-offset-3'><label class='hidden' for='id" +
              obj[i].Id +
              "'> Quantity </label><input type='number' class='form-control quantity' min='0' name='quantity' value='1' id='" +
              obj[i].Id +
              "'><div class='input-group-btn'><button class='btn btn-default addToCart'>Add to cart</button> </div></div></div></li> ";
          }
          $("#productslist").html(html);
        }
      }
    );
  }

  function searchCategory() {
    var key = $(this).html();
    var provider = $("#provider").val();
    $.get(
      "/ProgettoTecWeb/controller/action/searchProducts.php",
      { key: key, provider: provider },
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
              " alt='" +
              obj[i].Description +
              "' /> <p class='description'>" +
              obj[i].Description +
              "<p class='price'> Price:  €  <span class='value'>" +
              obj[i].Price +
              "</span> </p> " +
              "<div class='row'><div class='input-group buttons col-xs-3 col-2 col-xs-offset-3 col-offset-3'><label class='hidden' for='id" +
              obj[i].Id +
              "'> Quantity </label><input type='number' class='form-control quantity' min='0' name='quantity' value='1' id='" +
              obj[i].Id +
              "'><div class='input-group-btn'><button class='btn btn-default addToCart'>Add to cart</button> </div></div></div></li> ";
          }
          $("#productslist").html(html);
        }
      }
    );
  }
  //Search the product written by the user
  function searchWithKeyPress(e) {
    if (e.which == 13) {
      // if the key is "Enter"
      search();
    }
  }

  function addToCart() {
    var id = $(this)
      .parent()
      .parent()
      .parent()
      .siblings(".id")
      .val();
    var name = $(this)
      .parent()
      .parent()
      .parent()
      .siblings(".name")
      .html();
    var price = $(this)
      .parent()
      .parent()
      .parent()
      .siblings(".price")
      .children(".value")
      .html();
    var li = $(this)
      .parent()
      .parent()
      .parent()
      .parent();
    //console.log(id + " "+ price + " " + name);
    var quantity = $(this)
      .parent()
      .siblings(".quantity")
      .val();

    if (quantity > 0) {
      $.get(
        "/ProgettoTecWeb/controller/action/addProductToCart.php",
        { id: id, quantity: quantity, name: name, price: price },
        function(data) {
          if (data === "Something's wrong with the inseriment in the cart.") {
            var html =
              "<div class='alert alert-danger'>" + data + "</div> <br/>";
          } else {
            var html =
              "<div class='alert alert-success'>" + data + "</div> <br/>";
          }
          li.append(html);
        }
      );
    } else if (quantity < 0) {
      var html =
        "<div class='alert alert-danger'>Negative value are not permitted </div> <br/>";
      li.append(html);
    }
    $(this)
      .parent()
      .siblings(".quantity")
      .val("1");
  }

  $(".category").click(searchCategory);
  $("#searchBar").keypress(searchWithKeyPress);
  $("#searchButton").click(search);
  $("#productslist").on("click", ".addToCart", addToCart);
  $("#productslist").on("focusin", ".quantity", function() {
    setTimeout(function() {
      $(".alert-success").fadeOut();
      $(".alert-danger").fadeOut();
    }, 1000);
  });
});
