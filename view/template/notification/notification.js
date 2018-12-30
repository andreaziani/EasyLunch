$(document).ready(function () {
    function tryReview(orderId) {
        $.get("../../../controller/action/tryReview", orderId);
    }
});