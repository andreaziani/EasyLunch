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
              "<li> <input class='hidden' name='id' type='number' value='" +
              obj[i].Id +
              "'/> <img src=/ProgettoTecWeb/" +
              obj[i].Image +
              " alt='Image of the product' width=70 /><h2>" +
              obj[i].Name +
              "</h2><p class='description'>" +
              obj[i].Description +
              "</p><p class='price'> Prezzo: " +
              obj[i].Price +
              " euro</p><input type='number' name='quantity' value='0'><button>Add to cart</button> </li> ";
          }
          $("#productslist").html(html);
        }
      }
    );
    $("#searchBar").val(" "); //clear the search bar
  }
  //Search the product written by the user
  function searchWithKeyPress(e) {
    if (e.which == 13) {
      // if the key is "Enter"
      search();
    }
  }
  $("#searchBar").keypress(searchWithKeyPress);
  $("#searchButton").click(search);
});
