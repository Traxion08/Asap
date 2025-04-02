<?php 
$con=new mysqli("localhost","root","");
$db=mysqli_select_db($con,"asap") or die(mysqli_error($con));
?>