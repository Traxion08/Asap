<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id = (int)$_POST['id']; 
        $action = $_POST['action'];

        if ($action == 'delete') {
            // Fetch username and userphonenumber for the given ID
            $sql_fetch = "SELECT username, userphonenumber FROM report WHERE id = $id";
            $result_fetch = $conn->query($sql_fetch);

            if ($result_fetch->num_rows > 0) {
                $row = $result_fetch->fetch_assoc();
                $username = $row['username'];
                $userphone = $row['userphonenumber'];

                // Check if user exists in the register table
                $sql_check = "SELECT * FROM register WHERE name = '$username' AND mobile = '$userphone'";
                $result_check = $conn->query($sql_check);

                if ($result_check->num_rows > 0) {
                    // Delete the user from the register table
                    $sql_delete_register = "DELETE FROM register WHERE name = '$username' AND mobile = '$userphone'";
                    $conn->query($sql_delete_register);
                } else {
                    // If no matching user is found in the register table
                    echo "
                    <script>
                        alert('No matching user found in the register table.');
                        window.location.href = 'new_2.php';
                    </script>
                    ";
                    exit(); // Stop further execution
                }

                // Update the status of the report to 'Removed'
                $sql_update_request = "UPDATE report SET status = 'Removed' WHERE id = $id";
                if ($conn->query($sql_update_request) === TRUE) {
                    echo "
                    <script>
                        alert('Status updated to Removed.');
                        window.location.href = 'new_2.php';
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                        alert('Error updating status: ".$conn->error."');
                        window.location.href = 'new_2.php';
                    </script>
                    ";
                }
            } else {
                // If no matching request is found in the report table
                echo "
                <script>
                    alert('No matching request found.');
                    window.location.href = 'new_2.php';
                </script>
                ";
            }
        } else {
            echo "Invalid action.";
        }
    } else {
        echo "Missing id or action.";
    }
}

// Fetch all requests to display in the table
$sql_1 = "SELECT * FROM report";
$result = $conn->query($sql_1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4b5e6b, #f1f8e9);
        }
        .btn {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6 text-center">USER REPORTS</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 border-b text-left">ID</th>
                    <th class="py-3 px-6 border-b text-left">Name</th>
                    <th class="py-3 px-6 border-b text-left">Phone Number</th>
                    <th class="py-3 px-6 border-b text-left">Driver Name</th>
                    <th class="py-3 px-6 border-b text-left">Driver Phone</th>
                    <th class="py-3 px-6 border-b text-left">Vehicle Number</th>
                    <th class="py-3 px-6 border-b text-left">Request Time</th>
                    <th class="py-3 px-6 border-b text-left">Status</th>
                    <th class="py-3 px-6 border-b text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='hover:bg-gray-100'>
                            <td class='py-3 px-6 border-b'>".$row['id']."</td>
                            <td class='py-3 px-6 border-b'>".$row['username']."</td>
                            <td class='py-3 px-6 border-b'>".$row['userphonenumber']."</td>
                            <td class='py-3 px-6 border-b'>".$row['drivername']."</td>
                            <td class='py-3 px-6 border-b'>".$row['driverphonenumber']."</td>
                            <td class='py-3 px-6 border-b'>".$row['vehiclenumber']."</td>
                            <td class='py-3 px-6 border-b'>".$row['request_time']."</td>
                            <td class='py-3 px-6 border-b'>".$row['status']."</td>
                            <td class='py-3 px-6 border-b'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='action' value='delete' class='border border-gray-300 rounded-md bg-red-500 text-white px-4 py-2'>block</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='py-3 px-6 text-center'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
