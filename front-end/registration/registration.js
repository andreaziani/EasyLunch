$(document).ready(function() {
  
    //check if the fields are not valid
  function check(str) {
    var queries = ["select", "update", "delete", "insert", "alter", " "];
    var label = str + "Error";
    var val = $("#" + str)
      .val()
      .toLowerCase();
    if (val.length === 0) {
      $("#" + label).show();
      return false;
    }
    for (var i = 0; i < queries.length; i++) {
      if (val.search(queries[i]) != -1) {
        console.log(queries[i]);
        $("#" + label).show();
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
      $("#rPasswordError").show();
      isGood = false;
    }
    if (isGood) {
      // TODO: send server request
    }
  }

  //on change in the typology box, piva label appear and disappear
  $("#typology").change(function(){
    if($("#typology option:selected").val() == "provider"){
        $("#pivaLabel").show();  
   }
  });
  $("#typology").change(function(){
    if($("#typology option:selected").val() == "client"){
        $("#pivaLabel").hide();
   }
  });

  
  $("#submit").click(submit);
  $("#username").focusin(() => $("#usernameError").hide());
  $("#password").focusin(() => $("#passwordError").hide());
  $("#name").focusin(() => $("#nameError").hide());
  $("#surname").focusin(() => $("#surnameError").hide());
  $("#rPassword").focusin(() => $("#rPasswordError").hide());
});
