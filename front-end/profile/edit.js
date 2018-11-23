$(document).ready(function () {
    var hiddenButton = $(".hiddenButton");
    $("a.edit").click(function (e) { 
        $(this).prev().children().prop("disabled", false);
        hiddenButton.fadeIn();
    });
});