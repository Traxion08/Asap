<?php 
include("connection.php");

$email=$_POST["email"];
$password=$_POST["password"];
$query="SELECT * FROM `ambulance_register` WHERE email='$email' && password='$password' AND status='approve'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_row($result);
if(mysqli_num_rows($result)>0)
{
    $response["status"]="1";
    $response["message"]="Login Successful";

    $response["id"]=$row["0"];
    $response["name"]=$row["1"];
    $response["phonenumber"]=$row["2"];
    $response["email"]=$row["3"];
    $response["vehiclenumber"]=$row["4"];
    $response["password"]=$row["6"];

 

}
else
{
    $response["status"]="0";
    $response["message"]="Login failed";

    $response["id"]="";
    $response["name"]="";
    $response["phonenumber"]="";
    $response["email"]="";
    $response["vehiclenumber"]="";
    $response["password"]="";


}
echo json_encode($response);
?>