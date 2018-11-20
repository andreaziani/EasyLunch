$(document).ready(function() {
  function submit(){
      var user = $("#username").val().toLowerCase();
      var password = $("#password").val().toLowerCase();
      var queries = ["select", "update", "delete", "insert", "alter", " "];
      var isGood = true;

      if(user.length === 0){
          isGood = false;
          $("#usernameError").show();
      }
      if(password.length === 0){
          isGood = false;
          $("#passwordError").show();
      }
      for (var i = 0; i < queries.length; i++){
        if (user.search(queries[i]) != -1){
            $("#usernameError").show();
            isGood = false;
        }
        if (password.search(queries[i]) != -1){
            $("#passwordError").show();
            isGood = false;
        }
      }
      if(isGood){
          // TODO: send server request
      }
  }

  $("#submit").click(submit);
  $("#username").focusin(() => $("#usernameError").hide());
  $("#password").focusin(() => $("#passwordError").hide());
});
