<?php
include 'conn.php';
$a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM ambulance_register"))['count'];

$b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM request"))['count'];

$c= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM register"))['count'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Internal CSS for custom styles */
        .sidebar {
            background-color: #2D3748; 
        }
        .card {
            background-color: #ffffff; 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 0.5rem;
            transition: transform 0.2s, box-shadow 0.2s; 
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        .card-header {
            background-color: #3B82F6; 
            color: #ffffff; 
            border-radius: 0.5rem 0.5rem 0 0; 
        }
        .table-header {
            background-color: #f3f4f6; 
        }
        .menu-button {
            display: none; 
        }
        @media (max-width: 640px) {
            .sidebar {
                position: fixed;
                z-index: 10;
                top: 0;
                bottom: 0;
                left: -100%; 
                transition: left 0.3s;
            }
            .sidebar.open {
                left: 0; 
            }
            .menu-button {
                display: block; 
                color: white;
                padding: 1rem;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-teal-500 via-cyan-500 to-green-400 text-white">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 h-screen p-5">
            <h1 class="text-white text-2xl font-bold mb-5">Police Dashboard</h1>
            <ul>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="adm.html"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="new.php"><i class="fas fa-ambulance"></i>Ambulances</a>
                </li>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="new_1.php"><i class="fas fa-user"></i>Users</a>
                </li>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="new_3.php"><i class="fas fa-user"></i>Request</a>
                </li>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="new_2.php"><i class="fas fa-user-injured"></i>Report</a>
                <li class="text-gray-300 hover:text-white mb-2 transition-colors">
                    <a href="adlogin.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-6">Dashboard Overview</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Cards for statistics -->
                <div class="card p-5">
                    <div class="card-header p-4 flex items-center">
                        <i class="fas fa-ambulance text-white mr-2"></i>
                        <h3 class="text-lg font-semibold">Ambulance</h3>
                    </div>
                    <p class="text-3xl font-bold text-blue-600"><?php echo $a; ?></p>
                </div>
                <div class="card p-5">
                    <div class="card-header p-4 flex items-center">
                        <i class="fas fa-car-crash text-white mr-2"></i>
                        <h3 class="text-lg font-semibold">Request</h3>
                    </div>
                    <p class="text-3xl font-bold text-red-600"><?php echo $b; ?></p>
                </div>
                <div class="card p-5">
                    <div class="card-header p-4 flex items-center">
                        <i class="fas fa-user-injured text-white mr-2"></i>
                        <h3 class="text-lg font-semibold">Users</h3>
                    </div>
                    <p class="text-3xl font-bold text-green-600"><?php echo $c; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
