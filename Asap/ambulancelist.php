<?php
include("connection.php");



//creating a query

$stmt = $con->prepare( "SELECT id,name,phonenumber,email,vehiclenumber,latitude,longitude FROM ambulance_register ");

//Executting the query

$stmt->execute();

//binding result to the query

$stmt->bind_result($id,$name,$phonenumber,$email,$vehiclenumber,$latitude,$longitude);

$p=array();

while($stmt->fetch()){
    $temp=array();
    $temp['id']=$id;
    $temp['name']=$name;
    $temp['phonenumber']=$phonenumber;
    $temp['email']=$email;
    $temp['vehiclenumber']=$vehiclenumber;
    $temp['latitude']=$latitude;
    $temp['longitude']=$longitude;
 
  
    array_push($p,$temp);

}
echo json_encode($p);