$(document).ready(function () {
    function doPoll(){
        $.get('../../../controller/action/getNotifications.php', function(data) {
            //TODO set bell accordingly
            setTimeout(doPoll, 1000);
        });
    }
    doPoll();
});