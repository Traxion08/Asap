<?php
include("connection.php");
$id=$_POST["id"];
$dname =$_POST["name"];
$phonenumber =$_POST["phonenumber"];
$demail =$_POST["email"];
$vehiclenumber =$_POST["vehiclenumber"];

$dpassword =$_POST["password"];


$query="update ambulance_register set name='$dname',phonenumber='$phonenumber',email='$demail',vehiclenumber='$vehiclenumber',password='$dpassword' where id='$id'";
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