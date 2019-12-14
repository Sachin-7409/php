<?php
<h3 align="center"> this is php programs </h3>
if(isset ($_GET["stu_name"]) && isset($_GET["stu_age"])&&isset($_GET["stu_weight"]))
{
$name=$_GET["stu_name"];
$age=$_GET["stu_age"];
$weight=$_GET["stu_Weight"];

if(!empty($name) || !empty($age)  || !empty($weight))
{
echo 'Name:'.$_GET["stu_name"].'<br>';
echo 'Age: '.$_GET["stu_age"].'<br>';
echo 'Weight:'.$_GET["stu_weight"].'<br>';

}}
else{

echo"Please enter all fields";

}

?>
