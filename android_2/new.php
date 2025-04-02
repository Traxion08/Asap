<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $sql = "UPDATE ambulance_register SET status='approve' WHERE id=$id";
    } elseif ($action == 'reject') {
        $sql = "DELETE FROM ambulance_register WHERE id=$id";
        echo "
       <script>alert('rejected');
            window.location.href = 'new.php';
        </script>
        ";

    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert(' Approved successfully');
        window.location.href = 'new.php';
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch agency data
$sql = "SELECT * FROM ambulance_register";
$result = $conn->query($sql);
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
    <h2 class="text-3xl font-bold mb-6 text-center">Ambulance_Register</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 border-b text-left">ID</th>
                    <th class="py-3 px-6 border-b text-left">Name</th>
                    <th class="py-3 px-6 border-b text-left">phonenumber</th>
                    <th class="py-3 px-6 border-b text-left">Email</th>
                    <th class="py-3 px-6 border-b text-left">vehiclenumber</th>
                    <th class="py-3 px-6 border-b text-left">photo</th>
                    <th class="py-3 px-6 border-b text-left">latitude</th>
                    <th class="py-3 px-6 border-b text-left">longitude</th>
                    <th class="py-3 px-6 border-b text-left">Status</th>
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
                            <td class='py-3 px-6 border-b'>".$row['name']."</td>
                            <td class='py-3 px-6 border-b'>".$row['phonenumber']."</td>
                            <td class='py-3 px-6 border-b'>".$row['email']."</td>
                            <td class='py-3 px-6 border-b'>".$row['vehiclenumber']."</td>
                            <td class='py-3 px-6 border-b'>".$row['photo']."</td>
                            <td class='py-3 px-6 border-b'>".$row['latitude']."</td>
                            <td class='py-3 px-6 border-b'>".$row['longitude']."</td>
                            <td class='py-3 px-6 border-b'>".$row['status']."</td>
                            <td class='py-3 px-6 border-b'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='id' value='".$row['id']."'>
                                    <select name='action' onchange='this.form.submit()' class='border border-gray-300 rounded-md'>
                                        <option value=''>Select</option>
                                        <option value='approve'>Approve</option>
                                        <option value='reject'>Reject</option>
                                    </select>
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
