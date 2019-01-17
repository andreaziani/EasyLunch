$(document).ready(function() {
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
    //console.log(key);
    $.get(
      "/ProgettoTecWeb/controller/action/searchProviders.php",
      { key: key },
      function(data) {
        if (isJson(data)) {
          var obj = JSON.parse(data);
          var html = "";
          var rate = 0;
          console.log(obj);
          for (var i = 0; i < obj.length; i++) {
            html =
              html +
              "<li> " +
              "<form action='/ProgettoTecWeb/view/template/clientproductslist/clientproductslist.php' method='POST'>" +
              "<h2 class='companyname'>" +
              obj[i].CompanyName +
              "</h2>";
            if (obj[i].Rate !== null) {
              rate = obj[i].Rate;
            }
            for (var j = 0; j < 5; j++) { //stars
            	if (i < rate)
                	html = html + '<span class="fa fa-star orange-star"></span>';
				else 
				  	html = html + '<span class="fa fa-star"></span>';
            }
            html =
              html +
              "<p class='phonenumber'> Tel: " +
              obj[i].PhoneNumber +
              "</p><p class='email'> Email: " +
              obj[i].Email +
              "</p><p class='address'> Address: " +
              obj[i].AddressStreet +
              "<span> " +
              obj[i].AddressNumber +
              " <span/> </p> " +
              "<input class='hidden username' name='username' type='text' value='" +
              obj[i].UserName +
              "'/>";
            ("</form> </li>");
          }
          $("#providerlist").html(html);
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

  $("#providerlist").on("click", ".companyname", function(e) {
    $(this)
      .parent("form")
      .submit();
  });
  $("#providerlist").on("click", ".fa-star", function(e) {
    window.location = "/ProgettoTecWeb/view/template/review/showReview.php?companyname=" + $(this).siblings(".companyname").html();
  });
  $("#searchBar").keypress(searchWithKeyPress);
  $("#searchButton").click(search);
});
