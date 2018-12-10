/* @flow */
$(document).ready(function() {
  var hiddenButton = $(".hiddenButton");
  
  // check if value is not equal to params passed
  function check(value, element, param) {
    var notEqual = true;
    for (i = 0; i < param.length; i++) {
        if (value.toLowerCase().includes(param[i])) { notEqual = false; }
    }
    return this.optional(element) || notEqual;
  }
  /* Enable information editing */
  function editInformation() {
      var input = $(this)
      .prev()
      .children();
      if (input.is(":disabled")) {
          input.prop("disabled", false);
          input.val(" ");
          hiddenButton.fadeIn();
        }
    }
    
    /* Save the modified information */
    function saveChanges() {
        // TODO: send the modified info to webserver.
        $("form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    notEqualTo: ['select', 'alter', 'update', 'delete']
                },
                surname: {
                    required: true,
                    minlength: 3,
                    notEqualTo: ["select", "alter", "update", "delete"]
                },
                password: {
                    required: true,
                    minlength: 3,
                    notEqualTo: ["select", "alter", "update", "delete"]
                },
                birthdate: {
                    required: true,
                    date: true
                },
                telephone: {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true
                }
            }
        });
    }
    //add jQuery validator rule 
    jQuery.validator.addMethod("notEqualTo", check, "Please enter a diferent value.");

    $("a.edit").click(
        editInformation
        ); /*On click of edit icon, enable edit information */
        $("#saveChanges").click(saveChanges);
    });
    