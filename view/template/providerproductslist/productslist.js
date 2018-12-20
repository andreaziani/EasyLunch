/* @flow */
$(document).ready(function(){
    //variables
    var addProductButton = $("#addProduct");
    var hiddenForm = $("form.hidden");
    var invalidStrings = ['select', 'alter', 'update', 'delete'];

    /* shows the form to adding a new product */
    function addProduct(){
        addProductButton.hide();
        hiddenForm.fadeIn();
    }
    
    /* Hide the form for adding new product */
    function cancel(){
        hiddenForm.hide();
        $(".error:not(input, textarea)").hide();
        addProductButton.show();
    }
    
    /* Validation starts here */
    function check(value, element, param) {
        var notEqual = true;
        for (var i = 0; i < param.length; i++) {
            if (value.toLowerCase().includes(param[i])) { notEqual = false; } // check if value is not equal to params passed
        }
        return this.optional(element) || notEqual;
    }
    /* Validation function */
    function validation(param){
        $("form" + param).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    notEqualTo: invalidStrings
                },
                quantity: {
                    required: true,
                    number: true
                },
                description: {
                    required: true,
                    minlength: 5,
                    notEqualTo: invalidStrings
                },
                price: {
                    required: true,
                    number: true,
                    minlength: 1
                },
                id: {
                    required: true,
                    minlength: 1,
                    notEqualTo: invalidStrings
                },
                image: {
                    required: true,
                    extension: "png,jpeg,gif"
                }, 
                category: {
                    required: true
                }
            }
        });
    }
    
    /* Save the product */
    function saveProduct(){
        validation(".hidden");
    }
    
    /* Modify product */
    function modifyProduct(){
        var siblings = $(this).siblings()
        siblings.prop("disabled", false);
        siblings.children().prop("disabled", false);
        $(this).hide();
        $(this).next().hide();
        $(this).next().next().show();
    }
    
    /* Save changes written with modify */
    function saveModify(){
        validation("");
        if(Validator.numberOfInvalids === 0){ // if there are not errors.
            $(this).siblings().prop("disabled", false);
            $(this).siblings().children().prop("disabled", false);
            $(this).prevAll().show();
            $(this).hide();
        }
    }
    
    /* Remove product */
    function removeProduct(){
        var id = $(this).siblings("input.hidden");
        console.log(id);
        var li = $(this).parent();
        if (confirm("Are you sure to delete the product?")) { //shows a dialog to alert provider.
            // AJAX request to remove product from db.
            $.get("/ProgettoTecWeb/controller/action/removeProduct.php?id=" + id.val(), false).done(function(){
                alert("Product correctly deleted");
            });
            li.remove();
        }
        
    }
    
    //add jQuery validator rule 
    jQuery.validator.addMethod("notEqualTo", check, "Please enter a diferent value.");
    /* Activate listener from begin*/
    $("#addProduct").click(addProduct);
    $(".modify").click(modifyProduct);
    $(".saveModify").click(saveModify);
    $(".remove").click(removeProduct);
    $(".saveProduct").click(saveProduct);
    $(".cancel").click(cancel);
});