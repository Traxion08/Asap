<?php 
include("connection.php");

$name =$_POST["name"];
$mobile =$_POST["mobile"];
$email =$_POST["email"];
$age =$_POST["age"];
$password =$_POST["password"];

$q ="INSERT INTO register  (name,mobile,email,age,password) VALUES ('$name','$mobile','$email','$age','$password')";

$result=mysqli_query($con,$q);
if($result){
    $response["status"]="1";
    $response["message"]=" Registration successful";
}
else{
    $response["status"]="0";
    $response["message"]="Registration failed";
}
echo json_encode($response);
?>