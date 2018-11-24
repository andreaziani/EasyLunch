$(document).ready(function(){
    var addProductButton = $("#addProduct");
    var hiddenForm = $("form.hidden");
    var cancelButton = $("#cancel");
    var saveButton = $("#saveProduct");

    /* shows the form to adding a new product */
    function addProduct(){
        addProductButton.hide();
        hiddenForm.fadeIn();
    }

    /* Hide the form to adding new product */
    function cancel(){
        hiddenForm.hide();
        addProductButton.fadeIn("slow");
        hiddenForm.children().val(" ");
        hiddenForm.children().children().val(" ");
        
    }

    /* Save the product */
    function saveProduct(){
        //TODO: validate form and send to the web server.
    }

    addProductButton.click(addProduct);
    cancelButton.click(cancel);
    saveButton.click(saveProduct);
});