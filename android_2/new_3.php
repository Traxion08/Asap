<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id = (int)$_POST['id']; 
        $action = $_POST['action'];

        if ($action == 'delete') {
            $sql = "DELETE FROM request WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "
                <script>
                    alert('Record deleted successfully.');
                    window.location.href = 'new_2.php';
                </script>
                ";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Invalid action.";
        }
    } else {
        echo "Missing id or action.";
    }
}

$sql_1 = "SELECT * FROM request";
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
    <h2 class="text-3xl font-bold mb-6 text-center">USER_REQUESTS</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 border-b text-left">ID</th>
                    <th class="py-3 px-6 border-b text-left">Name</th>
                    <th class="py-3 px-6 border-b text-left">phonenumber</th>
                    <th class="py-3 px-6 border-b text-left">drivername</th>
                    <th class="py-3 px-6 border-b text-left">driverphonenumber</th>
                    <th class="py-3 px-6 border-b text-left">vehiclenumber</th>
                    <th class="py-3 px-6 border-b text-left">request_time</th>
                    <th class="py-3 px-6 border-b text-left">status</th>
                    <th class="py-3 px-6 border-b text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                // Assuming $result is obtained from a database query
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
                        <button type='submit' name='action' value='delete' class='border border-gray-300 rounded-md'>Delete</button>
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
