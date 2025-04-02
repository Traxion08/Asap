<?php
include("connection.php");

// Validate input
if (!isset($_POST['latitude']) || !isset($_POST['longitude'])) {
    echo json_encode(["status" => "0", "message" => "Latitude and Longitude are required"]);
    exit;
}

$userLatitude = $_POST['latitude'];
$userLongitude = $_POST['longitude'];

// Ensure inputs are numeric
if (!is_numeric($userLatitude) || !is_numeric($userLongitude)) {
    echo json_encode(["status" => "0", "message" => "Invalid Latitude or Longitude"]);
    exit;
}

// SQL query to calculate distance using the Haversine formula
$query = "
    SELECT id, name, phonenumber, vehiclenumber, latitude, longitude,
           (6371 * ACOS(
                COS(RADIANS(?)) * COS(RADIANS(latitude)) *
                COS(RADIANS(longitude) - RADIANS(?)) +
                SIN(RADIANS(?)) * SIN(RADIANS(latitude))
           )) AS distance
    FROM ambulance_register
    HAVING distance <= 10
    ORDER BY distance ASC
    LIMIT 1";
$stmt = $con->prepare($query);
$stmt->bind_param("ddd", $userLatitude, $userLongitude, $userLatitude);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
if ($row = mysqli_fetch_assoc($result)) {
    $response["status"] = "1";
    $response["data"] = array(
        "id" => $row["id"],
        "name" => $row["name"],
        "phonenumber" => $row["phonenumber"],
        "vehiclenumber" => $row["vehiclenumber"]
    );
} else {
    $response["status"] = "0";
    $response["message"] = "No nearby ambulances available";
}

echo json_encode($response);
?>
