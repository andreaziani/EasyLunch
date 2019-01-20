function tryOrderAction(orderId, action) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            window.location.href = xmlHttp.responseText;
        }
    }; 
    xmlHttp.open("GET", "../../../controller/action/" + action + ".php?orderId=" + orderId);
    xmlHttp.send(null);
    return xmlHttp.responseText;
}


function tryReview(orderId) {
    return tryOrderAction(orderId, "tryReview");
}

function trySend(orderId) {
    return tryOrderAction(orderId, "trySend");
}