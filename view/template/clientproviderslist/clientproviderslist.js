$(document).ready(function () {
    $("li").click(function (e) { 
       $(this).children("form").submit();
    });
});