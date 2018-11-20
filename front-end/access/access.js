$(document).ready(function() {
  function submit(){
      var user = $("#username").val().toLowerCase();
      var password = $("#password").val().toLowerCase();
      var queries = ["select", "update", "delete", "insert", "alter", " ", ""];
      var isGood = true;
      for (var i = 0; i < queries.length; i++){
        if (user.search(queries[i]) != -1){
            $("#usernameError").html("Invalid username");
            isGood = false;
        }
        if (password.search(queries[i]) != -1){
            $("#passwordError").html("Invalid password");
            isGood = false;
        }
      }
      if(isGood){
          // TODO: send server request
      }
  }

  $("#submit").click(submit);
  $("#username").focusin(() => $("#usernameError").html(""));
  $("#password").focusin(() => $("#passwordError").html(""));
});
