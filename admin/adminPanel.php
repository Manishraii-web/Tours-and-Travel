<?php
session_start(); 
// Uncomment the next lines to enforce admin authentication
// if (!isset($_SESSION['AdminLoginId'])) {
//     header("Location: adminlogin.php"); 
//     exit();
// }

// Set the default page
$selectedPage = 'dashboard';

// Dynamically set the page if the "page" parameter is provided
if (isset($_GET['page'])) {
    $selectedPage = $_GET['page'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra's Dashboard</title>
    <!-- Optionally include your admin panel CSS -->
    <!-- <link rel="stylesheet" href="adminPanel.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        /* Example styles for the dashboard */
        .content {
            margin-left: 250px; /* Adjust based on your sidebar width */
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .dynamic-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Main Content Area -->
    <div class="content">
        <h2>Greeting, Master</h2>
        <div class="dynamic-content">
            <?php
            // Load content based on the selected page
            switch ($selectedPage) {
                case 'add_package':
                    include('add_package.php');
                    break;
                case 'manage_users':
                    include('manage_user.php');
                    break;
                case 'manage_booking':
                    include('manage_booking.php');
                    break;
                case 'manage_hotel':
                    include('add_hotel.php');
                    break;
                    case 'suggestion':
                        include('suggestion.php');
                        break;
                case 'report':
                    include('report.php');
                    break;
                default:
                    echo "<h3>Welcome to the Dashboard</h3>";
                    echo "<p>Select a link from the sidebar to manage the content.</p>";
                    break;
            }
            ?>
        </div>
    </div>
</body>
</html>
