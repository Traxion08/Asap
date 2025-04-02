<?php
include("connection.php");

$currentAmbulanceId = $_POST['currentAmbulanceId'];
$userLatitude = $_POST['latitude'];
$userLongitude = $_POST['longitude'];
$username = $_POST['username'];  // Accept username as POST parameter
$userPhoneNumber = $_POST['userphonenumber'];  // Accept user phone number as POST parameter

// Validate inputs
if (!isset($currentAmbulanceId, $userLatitude, $userLongitude, $username, $userPhoneNumber)) {
    echo json_encode(["status" => "0", "message" => "Missing parameters"]);
    exit;
}

// Query to find the next nearest ambulance, excluding the current one
$query = "
    SELECT id, drivername, driverphonenumber, vehiclenumber, latitude, longitude,
           (6371 * ACOS(
                COS(RADIANS($userLatitude)) * COS(RADIANS(latitude)) *
                COS(RADIANS(longitude) - RADIANS($userLongitude)) +
                SIN(RADIANS($userLatitude)) * SIN(RADIANS(latitude))
           )) AS distance
    FROM ambulance_register
    WHERE id != '$currentAmbulanceId'
    HAVING distance <= 10
    ORDER BY distance ASC
    LIMIT 1";

$result = mysqli_query($con, $query);

$response = array();
if ($row = mysqli_fetch_assoc($result)) {
    // Next ambulance found, passing details to request.php
    $response["status"] = "1";
    $response["data"] = array(
        "id" => $row["id"],
        "drivername" => $row["drivername"],
        "driverphonenumber" => $row["driverphonenumber"],
        "vehiclenumber" => $row["vehiclenumber"]
    );

    // Insert request data into the request table with dynamic username and user phone number
    $insertQuery = "INSERT INTO request (username, userphonenumber, drivername, driverphonenumber, vehiclenumber)
                    VALUES ('$username', '$userPhoneNumber', '{$row['drivername']}', '{$row['driverphonenumber']}', '{$row['vehiclenumber']}')";

    if (mysqli_query($con, $insertQuery)) {
        $response["message"] = "Request inserted successfully";
    } else {
        $response["status"] = "0";
        $response["message"] = "Error inserting request";
    }

} else {
    $response["status"] = "0";
    $response["message"] = "No nearby ambulances available";
}

echo json_encode($response);
?>
