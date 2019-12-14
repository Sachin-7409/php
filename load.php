<?php include('process.php'); ?>
<html>
<head>
  <title>Register</title>
  <style>
body {
  background: #A9D9C3;
}
#register_form h1 {
  text-align: center;
}
#register_form {
  width: 37%;
  margin: 100px auto;
  padding-bottom: 30px;
  border: 1px solid #918274;
  border-radius: 5px;
  background: white;
}
#register_form input {
  width: 80%;
  height: 35px;
  margin: 5px 10%;
  font-size: 1.1em;
  padding: 4px;
  font-size: .9em;
}
#reg_btn {
  height: 35px;
  width: 80%;
  margin: 5px 10%;
  color: white;
  background: #3B5998;
  border: none;
  border-radius: 5px;
}
/*Styling for errors on form*/
.form_error span {
  width: 80%;
  height: 35px;
  margin: 3px 10%;
  font-size: 1.1em;
  color: #D83D5A;
}
.form_error input {
  border: 1px solid #D83D5A;
}

/*Styling in case no errors on form*/
.form_success span {
  width: 80%;
  height: 35px;
  margin: 3px 10%;
  font-size: 1.1em;
  color: green;
}
.form_success input {
  border: 1px solid green;
}
#error_msg {
  color: red;
  text-align: center;
  margin: 10px auto;
};
  </style>    
</head>
<body>
 <form id="register_form">
      <h1>Register</h1>
      <div id="error_msg"></div>
     
      <div>
        <input type="email" name="email" placeholder="Email" id="email">
        <span></span>
      </div>
     
      <div>
        <button type="button" name="register" id="reg_btn">Register</button>
      </div>
    </form>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('document').ready(function(){
 var email_state = false;
  $('#email').on('blur', function(){
    var email = $('#email').val();
    if (email == '') {
        email_state = false;
        return;
    }
    $.ajax({
      url: 'formaj.php',
      type: 'post',
      data: {
        'email_check' : 1,
        'email' : email,
      },
      success: function(response){
          
        if (response == 'taken' ) {
          email_state = false;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Sorry... Email already taken');
        }else if (response == 'not_taken') {
          email_state = true;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_success");
          $('#email').siblings("span").text('Email available');
        }
      }
    });
 });

});
</script>

