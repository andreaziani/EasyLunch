$(document).ready(function () {

    function now() { 
        var date = new Date();
        date.setHours(0, 0, 0, 0);
        return date;
     }

    $("#submit").click(function (e) { 
        $.post("ProgettoTecWeb/controller/action/submitCart.php");
    });
    $("#cancel").click(function(e) {
        $.get("ProgettoTecWeb/controller/action/cancelCart.php");
    });
    
    $.validator.addMethod("time", function (value, element) {
        var validTime = /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);
        return this.optional(element) || validTime;
    }, "Please enter a valid time.");

    $.validator.addMethod("afterNow", function(value, element) {
        return new Date(value) >= now();
    }, "Choose a date in the future."); //TODO better message

    $.validator.addMethod("afterTime", function(value, element) {
        var v = value.split(":");
        var date = new Date($("#date").val());
        date.setHours(v[0], v[1], 0, 0);
        return date > new Date();
    }, "Choose a time in the future."); //TODO better message
    
    $("#checkoutform").validate({
        rules: {
            nominative: {
                required: true,
            },
            deliverySpot: {
                required: true,
            },
            deliveryDate: {
                required: true,
                date: true,
                afterNow: true
            },
            deliveryTime: {
                required: true,
                time: true,
                afterTime: true //TODO bad
            }
        }
    });
    $("button[name='remove']").click(function() {
        var productId = $(this).attr("id").split('_')[1];
        $.get("/ProgettoTecWeb/controller/action/dropCartEntry.php?id=" + productId, false).done(function(message){
            //alert(message);
        });
        $(this).parent().parent().remove();
        if ($("tbody tr").length === 0) {
            document.location.href = "/ProgettoTecWeb/view/template/cart/cartPage.php";
        }
    });
});
