<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

      $(document).ready(function(){

          $('#myfun').click(function() {
              $('#loaddata').load('load.html')
              alert("hello");
          });
      });
  
     
</script>
</head>

<body>
<div class="container">
<div id="loaddata">
  <h1>   this is going to change ..!</h1>
     </div>
     <button class="btn" id="myfun">clickon</button>

    </div> 

</body>

</html>



/*
<script>
    $('document').ready(function(){
  var email_state = false;
 	
  $('#email').on('blur', function(){
 	var email = $('#email').val();
 	if (email == '') {
 		email_state = false;
 		return;
 	}
 	$.ajax({
      url: 'formaj.php',
      type: 'post',
      data: {
      	'email_check' : 1,
      	'email' : email,
      },
      success: function(response){
      	if (response == 'taken' ) {
          email_state = false;
         // $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Sorry... Email already taken');
      	}
 	});
 });

 
});

</script>
*/
