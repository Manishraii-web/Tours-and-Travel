<?php
// Session start and authentication check if needed
// session_start(); 
// if (!isset($_SESSION['AdminLoginId'])) {
//     header("Location: adminlogin.php"); 
//     exit();
// }

$selectedPage = 'dashboard'; // Default page

if (isset($_GET['page'])) {
    $selectedPage = $_GET['page']; // Set the selected page based on the query parameter
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra's Dashboard</title>
    <!-- <link rel="stylesheet" href="adminPanel.css"> -->
     
</head>
<body>

    <!-- Sidebar -->
     <?php
     include"sidebar.php"
     ?>
             
   

    <div class="content">
        <h2>Greeting, Master</h2>

        <!-- Content Section - Dynamically Loaded Based on Selection -->
        <div class="dynamic-content">
            <?php
            // Include the corresponding content based on the selected page
            if ($selectedPage == 'add_package') {
                include('add_package.php');
            } elseif ($selectedPage == 'manage_users') {
                include('manage_user.php');
            } elseif ($selectedPage == 'manage_booking') {
                include('manage_booking.php');
            } elseif ($selectedPage == 'manage_hotel') {
                include('add_hotel.php');
            } elseif ($selectedPage == 'report') {
                include('report.php');
            } else {
                echo "<h3>Welcome to the Dashboard</h3>";
                echo "<p>Select a link to manage the content.</p>";
            }
            ?>
        </div>
    </div>


</body>
</html>
