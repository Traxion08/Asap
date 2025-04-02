<?php
include("connection.php");

// Check if the POST data and the file are set
if (isset($_POST["name"]) && isset($_POST["phonenumber"]) && isset($_POST["email"]) && 
    isset($_POST["vehiclenumber"]) && isset($_POST["password"]) && isset($_FILES['filename']) && isset($_POST["latitude"]) && isset($_POST["longitude"])) {

    // Get POST data
    $name = $_POST["name"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $vehiclenumber = $_POST["vehiclenumber"];
    $password = $_POST["password"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Get file data
    $originalImgName = $_FILES['filename']['name'];
    $tempName = $_FILES['filename']['tmp_name'];
    $folder = "uploads/";

    // Check if the uploads folder exists, if not create it
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Sanitize file name
    $originalImgName = basename($originalImgName);
    $uploadPath = $folder . $originalImgName;

    // Move uploaded file to the uploads directory
    if (move_uploaded_file($tempName, $uploadPath)) {
        // Insert into the database
        $q = "INSERT INTO ambulance_register (name, phonenumber, email, vehiclenumber, photo, password,latitude,longitude) 
              VALUES ('$name', '$phonenumber', '$email', '$vehiclenumber', '$originalImgName', '$password', '$latitude', '$longitude')";

        // Execute the query
        if (mysqli_query($con, $q)) {
            $response['status'] = "1";
            $response['message'] = "Data inserted successfully, file uploaded!";
        } else {
            $response['status'] = "0";
            $response['message'] = "Data insertion failed: " . mysqli_error($con);
        }
    } else {
        $response['status'] = "0";
        $response['message'] = "File upload failed";
    }
} else {
    $response['status'] = "0";
    $response['message'] = "Required fields are missing or the form is not submitted correctly.";
}

// Close the database connection
mysqli_close($con);

// Return the response
echo json_encode($response);
?>
