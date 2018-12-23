/* @flow */
$(document).ready(function() {
  //variables
  var invalidStrings = ["select", "alter", "update", "delete", " "];
  var hiddenButton = $(".hiddenButton");

  /* Enable information editing */
  function editInformation() {
    var input = $(this)
      .prev()
      .children();
    if (input.is(":disabled")) {
      input.prop("disabled", false);
      input.val("");
      hiddenButton.fadeIn();
    }
  }

  /* Validation starts here */
  function check(value, element, param) {
    var notEqual = true;
    for (var i = 0; i < param.length; i++) {
      if (value.toLowerCase().includes(param[i])) {
        notEqual = false;
      } // check if value is not equal to params passed
    }
    return this.optional(element) || notEqual;
  }

  /* Save the modified information */
  function saveChanges() {
    $("form").children().prop("disabled", false);
    // TODO: send the modified info to webserver.
    $("form").validate({
      rules: {
        Name: {
          required: true,
          minlength: 3,
          notEqualTo: invalidStrings
        },
        Surname: {
          required: true,
          minlength: 3,
          notEqualTo: invalidStrings
        },
        Birthdate: {
          required: true,
          date: true
        },
        PhoneNumber: {
          required: true,
          number: true,
          minlength: 5,
          maxlength: 10
        },
        Email: {
          required: true,
          email: true
        },
        IVA: {
          required: true,
          minlength: 5,
          maxlength: 20,
          notEqualTo: invalidStrings
        }
      }
    });
  }
  
  //add jQuery validator rule
  jQuery.validator.addMethod(
    "notEqualTo",
    check,
    "Please enter a diferent value."
  );
  $("a.edit").click(
    editInformation
  ); /*On click of edit icon, enable edit information */
  $("#saveChanges").click(saveChanges);
});
