<?php 
include("connection.php");

$email=$_POST["email"];
$password=$_POST["password"];
$query="SELECT * FROM `register` WHERE email='$email' && password='$password'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_row($result);
if(mysqli_num_rows($result)>0)
{
    $response["status"]="1";
    $response["message"]="Login Successful";



    $response["id"]=$row["0"];
    $response["name"]=$row["1"];
    $response["email"]=$row["2"];
    $response["mobile"]=$row["3"];
    $response["age"]=$row["4"];
    $response["password"]=$row["5"];
  

}
else
{
    $response["status"]="0";
    $response["message"]="Login failed";


    $response["id"]="";
    $response["name"]="";
    $response["email"]="";
    $response["mobile"]="";
    $response["age"]="";
    $response["password"]="";

}
echo json_encode($response);
?>