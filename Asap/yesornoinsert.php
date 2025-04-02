<?php
include("connection.php");

// Initialize response array
$response = [];

// Check if POST data is set and not empty
if (!isset($_POST["id"]) || !isset($_POST["status"]) || empty($_POST["id"]) || empty($_POST["status"])) {
    $response["status"] = "0";
    $response["message"] = "Invalid input.";
    echo json_encode($response);
    exit;
}

$id = $_POST["id"];
$status = $_POST["status"];

// Check if the entry already has a status (approved/disapproved) using a prepared statement
$check_query = "SELECT * FROM request WHERE id = ? AND (status = 'YES' OR status = 'NO')";
$check_stmt = $con->prepare($check_query);
$check_stmt->bind_param("s", $id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Entry already approved or disapproved
    $response["status"] = "0";
    $response["message"] = "This action has already been taken for this entry.";
    echo json_encode($response);
    exit;
}

// SQL query to update the status for the corresponding id using a prepared statement
$query = "UPDATE request SET status = ? WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ss", $status, $id);
$result = $stmt->execute();

// Prepare the response
if ($result) {
    $response["status"] = "1";
    $response["message"] = "Updation successful";
} else {
    $response["status"] = "0";
    $response["message"] = "Updation failed";
}

// Output the response as JSON
echo json_encode($response);
?>
