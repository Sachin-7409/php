<?php
 
// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'sachin');
define('DB_NAME', 'demo1');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Define variables and initialize with empty values
//$name = $email = $address = $password = "";
//$name_err = $email_err = $address_err = $password_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
   // username and password sent from form 
     $name=mysqli_real_escape_string($link,$_POST['name']); 
     $password=mysqli_real_escape_string($link,$_POST['password']); 
     $sql="SELECT id FROM  demo1.employees  WHERE name='".$name."' && password='".$password."'";
     $result=mysqli_query($link,$sql);
     $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
     $active=$row['active'];
 
     $count=mysqli_num_rows($result);
 
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)
    {
     
     header("location: showdata.php");
    }
    else 
    {
    $error="Please don't get fast take  the  time and fill data properly  Thank you..! ";
    }
  }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body{
            background-color:bisque;
        }
        .wrapper{
            background-color:white;
            margin-top:10%;
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
                        <h2 style="font-weight: bold;">Login/signup </h2>
                    </div>
                    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $error;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $error;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="login.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

