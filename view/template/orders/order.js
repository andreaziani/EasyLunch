function tryOrderAction(orderId, action) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            window.location.href = xmlHttp.responseText;
        }
    }; 
    xmlHttp.open("GET", "/ProgettoTecWeb/controller/action/" + action + ".php?orderId=" + orderId);
    xmlHttp.send(null);
    return xmlHttp.responseText;
}


function tryReview(orderId) {
    return tryOrderAction(orderId, "tryReview");
}

function trySend(orderId) {
    return tryOrderAction(orderId, "trySend");
}

$(document).ready(function(){
    $("button[name=toggle_details]").click(function() {
        var pre = $(this).parent().find("pre");
        if(pre.is(":visible")) {
            $(this).text("Show details");
            pre.hide();
        } else {
            $(this).text("Hide details");
            pre.show();
        }
    });
    $('#showCompleted').click(function() {
        $(".table-success").toggle(this.checked);
    });
});