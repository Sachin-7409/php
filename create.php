<?php

// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'sachin');
define('DB_NAME','demo1');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Define variables and initialize with empty values
$name = $email = $address = $password = $images="";
$name_err = $email_err = $address_err =$password_err = $img_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //  print_r($_FILES); die;
    //$_FILES["images"]
    // die;
    // Validate name
    // print_r($imgvariable);die;
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    // validate email address
    $input_email=trim($_POST["email"]);
      if(empty($input_email)){
          $email_err="Please enter the emailid";
          }  elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
           $email_err="Invalid email format";
        }else{
            $email=$input_email;
        }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter the password.";     
    } else{
        $password = $input_password;
    }
     $input_images= $_FILES["images"]["name"];
     if(empty($input_images)){
         $img_err="please enter the image";
     }else
     {   $images   = $input_images;
         $tempname = $_FILES["images"]["tmp_name"];
         $imgvariable = move_uploaded_file($tempname,"images/$images");
        // print_r('sasas'.$imgvariable ); die;
     }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($address_err) && empty($password_err) && empty($img_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, email, address, password, images) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_address, $param_password,$param_images);
            
            // Set parameters
            $param_name = $name;
            $param_email= $email;
            $param_address = $address;
            $param_password = $password;
            $param_images= $images;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: login.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body{
            background-color:#76bbbb;
        }
        .wrapper{
            background-color:white;
            margin-top:35px;
            padding:15px;
            border-radius:20px;
            width:40%;
        }
        .wrapper:hover{
          background-color:black;
          color:white;
        }
    </style>

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 style="font-weight: bold;">REGISTRATION INFO </h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group  <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>EmailId</label>
                            <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Image</label>
                            <input type="file" name="images"  value="<?php echo $images; ?>">
                            <span class="help-block"><?php echo $img_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('document').ready(function(){
 var email_state = false;  
  $('#email').on('blur',function(){ 
 	var email = $('#email').val();
 	if (email == '') {
 		email_state = false;
 		return;
 	}
    
 	$.ajax({
       url: 'process.php',
       type: 'post',
       data: {
       	'email_check' : 1,
       	'email' : email,
       },
   success: function(response){
          
       	if (response == 'taken' ) {
               //alert("hello");
           email_state = false;
           $('#email').parent().removeClass();
           $('#email').parent().addClass("form_error");
           $('#email').siblings("span").text('Sorry... Email already taken');
       	}else if (response == 'not_taken') {
       	  email_state = true;
       	  $('#email').parent().removeClass();
       	  $('#email').parent().addClass("form_success");
       	  $('#email').siblings(".help-block").text('Email available');
     	}
       }
 	 });

    /* 
      $.ajax({
         url: "process.php",
        type: "POST",
        data: {email: 'bishtsachin050@gmail.com'},
        dataType: "html",
        success: function(data){
            console.log(data);
        } */
    });
  });


</script>


