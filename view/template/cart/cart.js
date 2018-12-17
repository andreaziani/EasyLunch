$(document).ready(function () {
    $("#submit").click(function (e) { 
        $.post("flie.php", cartData, //TODO this must be a global variable somewhere.
        );
    });
    $("#cancel").click(function(e) {
        $.get("file.php"); //TODO
    })
});