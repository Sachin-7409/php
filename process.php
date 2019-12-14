<?php 
// echo 'hello'; die;
  $db = mysqli_connect('localhost', 'root', 'sachin', 'demo1');
  
  if (isset($_POST['email'])) {
	  $email = $_POST['email'];
  	$sql = "SELECT * FROM employees WHERE email='$email'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['save'])) {
  	  	$email = $_POST['email'];
  	$sql = "SELECT * FROM employees WHERE email='$name'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "exists";	
  	  exit();
  	}
  }

?>