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
    <link rel="stylesheet" href="adminPanel.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <!-- Sidebar Links with PHP embedded, passing page parameters -->
            <li><a href="?page=add_package">Manage Packages</a></li>
            <li><a href="?page=manage_users">Manage Users</a></li>
            <li><a href="?page=manage_booking">View Bookings</a></li>
            <li><a href="?page=manage_hotel">Manage Hotels</a></li>
            <li><a href="?page=report">Reports</a></li>
        </ul>

        <!-- Logout Button -->
        <form method="POST">
            <button type="submit" name="logout" class="btn">Logout</button>
        </form>
    </div>

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

    <?php
    // PHP Logout
    if (isset($_POST["logout"])) {
        session_start();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
    ?>

</body>
</html>
