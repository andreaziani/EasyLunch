$(document).ready(function () {
    var hiddenButton = $(".hiddenButton");

    /* Enable information editing */
    function editInformation(){
        var input = $(this).prev().children();
        if(input.is(":disabled")){
            input.prop("disabled", false);
            input.val(" ");
            hiddenButton.fadeIn();
        }
    }

    /* Save the modified information */
    function saveChanges(){
        // TODO: validate the modified info.
        // TODO: send the modified info to webserver.
        var modifiedInfo = $("input:not(:disabled):not(#saveChanges)");
        for(var i = 0; i < modifiedInfo.length; i++){
            modifiedInfo.eq(i).val();
        }
    }

    $("a.edit").click(editInformation); /*On click of edit icon, enable edit information */
    $("#saveChanges").click(saveChanges);
});