<?php 
include("connection.php");

// Get input from POST request
$email = $_POST["email"];
$password = $_POST["password"];

// Prepare SQL statement to avoid SQL injection
$query = "SELECT * FROM `ambulance_register` WHERE email = ? AND password = ?";

// Prepare statement
$stmt = mysqli_prepare($con, $query);
if ($stmt === false) {
    // Error preparing the statement
    $response["status"] = "0";
    $response["message"] = "Database error: " . mysqli_error($con);
    echo json_encode($response);
    exit();
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "ss", $email, $password);

// Execute the query
mysqli_stmt_execute($stmt);

// Get result
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // User found, login successful
    $response["status"] = "1";
    $response["message"] = "Login Successful";

    $response["id"]=$row["0"];
    $response["name"]=$row["1"];
    $response["phonenumber"]=$row["2"];
    $response["email"]=$row["3"];
    $response["vehiclenumber"]=$row["4"];
    $response["photo"]=$row["5"];
    $response["password"]=$row["6"];
} else {
    // No user found, login failed
    $response["status"] = "0";
    $response["message"] = "Login failed";

    $response["id"]="";
    $response["name"]="";
    $response["phonenumber"]="";
    $response["email"]="";
    $response["vehiclenumber"]="";
    $response["photo"]="";
    $response["password"]="";
}

// Close statement
mysqli_stmt_close($stmt);

// Output the response as JSON
echo json_encode($response);
?>
