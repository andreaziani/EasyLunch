$(document).ready(function () {
    var emptyBell = "/ProgettoTecWeb/images/icons/bell.png";
    var fullBell = "/ProgettoTecWeb/images/icons/bell2.png";
    $("#bell").attr("src", emptyBell);
    function doPoll(){
        $.get('/ProgettoTecWeb/controller/action/getNotifications.php', function(isEmpty) {
            if (isEmpty) {
                $("#bell").attr("src", emptyBell);
                $("#bell").attr("alt", "empty alarm bell");
            } else {
                $("#bell").attr("src", fullBell);
                $("#bell").attr("alt", "full alarm bell");
            }
            setTimeout(doPoll, 1000);
        });
    }
    doPoll();
});