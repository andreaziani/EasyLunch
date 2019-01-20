$(document).ready(function () {
    $("#resetButton").click( function setRead() {
        $.ajax({
            type: 'GET',
            url: "../../../controller/action/setRead.php",
            data: {},
            success: function(data) { 
                    window.location.href = data;
                }
        });
    });

    $("tr[name='notification']").on("click", function(){
        window.location.href = "/ProgettoTecWeb/view/template/orders/orderPage.php";
    });

    function doPoll(){
        $.get('/ProgettoTecWeb/controller/action/getNotifications.php', function(data) {
            data = JSON.parse(data);
            //console.log(data);
            if (Array.isArray(data) && data.length) {
                var html = "<tr><th>Time</th><th>Description</th></tr>";
                for (var i = 0; i < data.length; i++) {
                    html += 
                        "<tr name='notification'>" +
                            "<td>" + data[i].timestamp + "</td>" +
                            "<td><pre>" + data[i].description + "</pre></td>" +
                        "</tr>";
                }
                html += "<input type='button' value='Reset notifications' onclick='setRead()'/>";
                $("#notificationTable").html(html);
                $("#notificationTable").show();
                $("#resetButton").show();
                $("#noNotificationMessage").hide();
                $("#notificationMessage").show();
            } else {
                $("#notificationTable").hide();
                $("#resetButton").hide();
                $("#noNotificationMessage").show();
                $("#notificationMessage").hide();
            }
            setTimeout(doPoll, 1000);
        });
    }
    doPoll();
});