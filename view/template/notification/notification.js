$(document).ready(function () {
    function tryReview(orderId) {
        $.get("../../../controller/action/tryReview.php", orderId);
    }
    function setRead() {
        console.log("Ciao");
        $.get("../../../controller/action/setRead.php");
    }

});
function tryReview(orderId) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "../../../controller/action/tryReview.php");
    xmlHttp.send(orderId);
    return xmlHttp.responseText;
}
function setRead() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "../../../controller/action/setRead.php");
    xmlHttp.send(null);
    return xmlHttp.responseText;
}
function a() {
    console.log("Ciao");
}