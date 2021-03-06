/* @flow */
$(document).ready(function(){
    //variables
    var addProductButton = $("#addProduct");
    var hiddenForm = $("ul.hidden");
    var invalidStrings = ['select', 'alter', 'update', 'delete'];
    /* shows the form to adding a new product */
    function addProduct(){
        addProductButton.hide();
        //console.log(hiddenForm);
        hiddenForm.removeClass("hidden");
    }
    
    /* Hide the form for adding new product */
    function cancel(){
        hiddenForm.addClass("hidden");
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
                    extension: "png,jpeg,gif,jpg"
                }, 
                category: {
                    required: true
                }
            }
        });
    }
    
    /* Save the product */
    function saveProduct(){
        validation(".newP");
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
        //console.log(id);
        var form = $(this).parent();
        //console.log(form);
        removedProducts = id.val();
        $(this).hide();
        var html = "<div class='alert alert-warning'> Are you sure to delete the product? ";
        html = html + "<input type='button' class='yes btn btn-primary btn-danger' value='Yes remove' /> <input type='button' class='no btn btn-primary' value='No' /> </div>"
        form.append(html);        
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
    
    $('li').on('click', '.yes', function(e){
        e.preventDefault();
        var form = $(this).parent().parent();
        var id = $(this).parent().siblings("input.hidden").val();
        console.log(id);
        $.get("/ProgettoTecWeb/controller/action/removeProduct.php?id=" + id , false).done(function(){
            $('.alert-warning').hide();
            var html = "<div class='alert alert-success'> Product correctly deleted </div> <br/>";
            form.append(html);
            setTimeout(function(){
                form.parent().remove();
              }, 1500);
        });
    });

    $('li').on('click', '.no', function(e){
        e.preventDefault();
        $('.alert-warning').hide();
        $(this).parent().siblings(".remove").show();
    });
});