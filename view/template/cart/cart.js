$(document).ready(function () {
    $("#submit").click(function (e) { 
        $.post("ProgettoTecWeb/controller/action/submitCart.php");
    });
    $("#cancel").click(function(e) {
        $.get("ProgettoTecWeb/controller/action/cancelCart.php");
    })
});