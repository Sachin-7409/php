<h1 align="center">
<?php 

  session_start();
if(isset($_SESSION["uname"]))
echo"welcome ".$_SESSION["uname"];
else
echo"you are not login";
?>
</h1>
<html>
<body>

<h2>
 <a href="logout.php" style="float:right">logout</a> </h2>
</body>
</html>
