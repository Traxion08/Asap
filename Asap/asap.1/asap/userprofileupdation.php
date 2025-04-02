<?php
include("connection.php");
$id=$_POST["id"];
$sname =$_POST["name"];
$semail =$_POST["email"];
$mobile =$_POST["mobile"];
$age =$_POST["age"];
$spassword =$_POST["password"];


$query="update register set name='$sname',email='$semail',mobile='$mobile',age='$age',password='$spassword' where id='$id'";
$result=mysqli_query($con,$query);
if($result)
{
$response["status"]="1";
$response["message"]="updation successfull";
}
else
{
    $response["status"]="0";
    $response["message"]="updation faild";
}
echo json_encode($response);
?>