$(document).ready(function () {
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
              console.log(obj);
              for (var i = 0; i < obj.length; i++) {
                html =
                  html +
                  "<li> "
                  + "<form action='/ProgettoTecWeb/view/template/clientproductslist/clientproductslist.php' method='POST'>" + 
                  "<h2 class='companyname'>" +
                  obj[i].CompanyName + 
                  "</h2> <p class='phonenumber'> Tel: " + 
                  obj[i].PhoneNumber +
                  "</p><p class='email'> Email: " + 
                  obj[i].Email +
                  "</p><p class='address'> Address: " +
                  obj[i].AddressStreet +
                  "<span> " +
                  obj[i].AddressNumber +
                  " <span/> </p> "
                  + "<input class='hidden username' name='username' type='text' value='" + obj[i].UserName +
                  "'/>"
                  "</form> </li>";
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

    $("li").click(function (e) { 
       $(this).children("form").submit();
    });
    $("#searchBar").keypress(searchWithKeyPress);
    $("#searchButton").click(search);
});