<?php
include("connection.php");


$driverphonenumber =$_POST["driverphonenumber"];
//creating a query

$stmt = $con->prepare( "SELECT id,username,userphonenumber,drivername,driverphonenumber,vehiclenumber,request_time,status FROM request WHERE driverphonenumber='$driverphonenumber' ");

//Executting the query

$stmt->execute();

//binding result to the query

$stmt->bind_result($id,$username,$userphonenumber,$drivername,$driverphonenumber,$vehiclenumber,$request_time,$status);

$p=array();

while($stmt->fetch()){
    $temp=array();
    $temp['id']=$id;
    $temp['username']=$username;
    $temp['userphonenumber']=$userphonenumber;
    $temp['drivername']=$drivername;
    $temp['driverphonenumber']=$driverphonenumber;
    $temp['vehiclenumber']=$vehiclenumber;
    $temp['request_time']=$request_time;
    $temp['status']=$status;
 
  
    array_push($p,$temp);

}
echo json_encode($p);