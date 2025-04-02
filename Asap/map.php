<?php
header("Content-Type: application/json");
$servername = "localhost";
$username = "root";
$password = "";
$database = "asap";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch ambulance locations
$sql = "SELECT latitude, longitude FROM ambulance_register WHERE status='approve'";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>