$(document).ready(function(){
    var addProductButton = $("#addProduct");
    var hiddenForm = $("form.hidden");
    
    /* shows the form to adding a new product */
    function addProduct(){
        addProductButton.hide();
        hiddenForm.fadeIn();
    }

    /* Hide the form to adding new product */
    function cancel(){
        hiddenForm.hide();
    }

    /* Save the product */
    function saveProduct(){
        //TODO: validate form and send to the web server.
    }

    function saveModify(){
        $(this).siblings().prop("disabled", false);
        $(this).siblings().children().prop("disabled", false);
        $(this).prevAll().show();
        $(this).hide();

        //TODO: validate and send to web server
    }

    function modifyProduct(){
        var siblings = $(this).siblings()
        siblings.prop("disabled", false);
        siblings.children().prop("disabled", false);
        $(this).hide();
        $(this).next().hide();
        $(this).next().next().show();
    }
    
    /* Activate listener from begin*/
    $("#addProduct").click(addProduct);
    $(".cancel").click(cancel);
    $(".saveProducts").click(saveProduct);
    $(".modify").click(modifyProduct);
    $(".saveModify").click(saveModify);
});