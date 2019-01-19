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

    function doPoll(){
        $.get('/ProgettoTecWeb/controller/action/getNotifications.php', function(data) {
            data = JSON.parse(data);
            if (Array.isArray(data) && data.length) {
                var html = "<tr><th>Time</th><th>Description</th></tr>";
                for (var i = 0; i < data.length; i++) {
                    html += "<tr>" +
                    "<td>" + data[i].timestamp + "</td>" +
                    "<td><pre>" + data[i].description + "</pre></td>";
                    //TODO: change way to make action maybe
                    if (data[i].typology == "ORDER_ARRIVED") {
                        html += "<td><input type='button' value='Review' onclick='tryReview("+ data[i].orderId +")'/></td>";
                    } else if (data[i].typology == "NEW_ORDER") {
                        html += "<td><input type='button' value='SendOrder' onclick='trySend("+ data[i].orderId +")'/></td>";
                    }
                    html += "</tr>";
                }
                html += "<input type='button' value='Reset notifications' onclick='setRead()'/>";
                $("#notificationTable").html(html);
                $("#notificationTable").show();
                $("#resetButton").show();
            } else {
                $("#notificationTable").hide();
                $("#resetButton").hide();
            }
            setTimeout(doPoll, 1000);
        });
    }
    doPoll();
});
function tryReview(orderId) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            window.location.href = xmlHttp.responseText;
        }
    }; 
    xmlHttp.open("GET", "../../../controller/action/tryReview.php?orderId=" + orderId);
    xmlHttp.send(null);
    return xmlHttp.responseText;
}