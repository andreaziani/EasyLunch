$(document).ready(function () {
    var addCathegoryButton = $("#addCathegory");
    var cancelButton = $("#cancel");
    var saveButton = $("#save");
    var removeButton = $(".remove");
    var invalidStrings = ['select', 'alter', 'update', 'delete'];
   
    /* Validation starts here */
    function check(value, element, param) {
        var notEqual = true;
        for (var i = 0; i < param.length; i++) {
            if (value.toLowerCase().includes(param[i])) { notEqual = false; } // check if value is not equal to params passed
        }
        return this.optional(element) || notEqual;
    }
    /* Validation function */
    function validation(){
        $("form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    notEqualTo: invalidStrings
                },
                id: {
                    required: true,
                    minlength: 1,
                    notEqualTo: invalidStrings
                }
            }
        });
    }
    /* Hide the form for adding new product */
    function cancel(e){
        e.preventDefault();
        $(".hidden").hide();
        $(".error:not(input, textarea)").hide();
        addCathegoryButton.show();
    }

    function removeCathegory(e){
        e.preventDefault();
        var id = $(this).siblings("input.hidden");
        console.log(id);
        var li = $(this).parent();
        if (confirm("Are you sure to delete the product?")) { //shows a dialog to alert admin.
            // AJAX request to remove category from db.
            $.get("/ProgettoTecWeb/controller/action/removeCategory.php?name=" + id.val(), false).done(function(){
                alert("Product correctly deleted");
            });
            li.remove();
        }
    }
    function add(e) { 
        e.preventDefault();
        $(".insert").fadeIn();
        addCathegoryButton.hide();
    };    
    /* Save the cathegory */
    function saveCathegory(){
        validation();
    }

    //add jQuery validator rule 
    jQuery.validator.addMethod("notEqualTo", check, "Please enter a diferent value.");
    addCathegoryButton.click(add);
    cancelButton.click(cancel);
    saveButton.click(saveCathegory);
    removeButton.click(removeCathegory);
});