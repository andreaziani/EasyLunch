$(document).ready(function() {
  
    //check if the fields are not valid
  function check(str) {
    var queries = ["select", "update", "delete", "insert", "alter", " "];
    var label = str + "Error";
    var val = $("#" + str)
      .val()
      .toLowerCase();
    if (val.length === 0) {
      $("#" + label).html("Invalid " + str);
      return false;
    }
    for (var i = 0; i < queries.length; i++) {
      if (val.search(queries[i]) != -1) {
        console.log(queries[i]);
        $("#" + label).html("Invalid " + str);
        return false;
      }
    }
    return true;
  }

  // submit the form, maybe can produce invalid labels.
  function submit() {
    var password = $("#password").val();
    var rPassword = $("#rPassword").val();
    isGood = check("name");
    isGood = check("surname") && isGood;
    isGood = check("password") && isGood;
    isGood = check("username") && isGood;
    if (password != rPassword) {
      $("#rPasswordError").html("Passwords are not the same");
      isGood = false;
    }
    if (isGood) {
      // TODO: send server request
    }
  }


  $("#typology").change(function(){
    if($("#typology option:selected").val() == "provider"){
        //$("#piva").style.display = 'contents';
    }
  });
  $("#submit").click(submit);
  $("#username").focusin(() => $("#usernameError").html(""));
  $("#password").focusin(() => $("#passwordError").html(""));
  $("#name").focusin(() => $("#nameError").html(""));
  $("#surname").focusin(() => $("#surnameError").html(""));
  $("#rPassword").focusin(() => $("#rPasswordError").html(""));
});
