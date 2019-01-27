$(document).ready(function () {
    var emptyBell = "/ProgettoTecWeb/images/icons/bell.png";
    var fullBell = "/ProgettoTecWeb/images/icons/bell2.png";
    $("#bell").attr("src", emptyBell);
    function doPoll(){
        $.get('/ProgettoTecWeb/controller/action/newNotifications.php', function(isEmpty) {
            if (isEmpty) {
                $("#bell").attr("src", emptyBell);
                $("#bell").attr("alt", "empty alarm bell");
                $("#bell").attr("longdesc", "/ProgettoTecWeb/images/icons/belldesc.txt");
            } else {
                $("#bell").attr("src", fullBell);
                $("#bell").attr("alt", "full alarm bell");
                $("#bell").attr("longdesc", "/ProgettoTecWeb/images/icons/bell2desc.txt");
            }
            setTimeout(doPoll, 1000);
        });
    }
    doPoll();
});