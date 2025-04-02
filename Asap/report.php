<?php
include("connection.php");

// Get POST data
$username = $_POST["username"];
$userphonenumber = $_POST["userphonenumber"];
$drivername = $_POST["drivername"];
$driverphonenumber = $_POST["driverphonenumber"];
$vehiclenumber = $_POST["vehiclenumber"];

// SQL query with NOW() for the current date and time
$q = "INSERT INTO report (username, userphonenumber, drivername, driverphonenumber, vehiclenumber, request_time) VALUES ('$username', '$userphonenumber', '$drivername', '$driverphonenumber', '$vehiclenumber', NOW())";

// Execute the query
$result = mysqli_query($con, $q);

// Prepare the response
$response = array();
if ($result) {
    $response["status"] = "1";
    $response["message"] = "Report successful";
} else {
    $response["status"] = "0";
    $response["message"] = "Registration failed";
}

// Output the response as JSON
echo json_encode($response);
?>
