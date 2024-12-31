<?php
session_start(); 

// If the admin is not logged in, redirect to the login page
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location: adminlogin.php"); // Redirect to the admin login page
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra's Dashboard</title>
    <link rel="stylesheet"  href="adminPanel.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2> Yatra's<br> Dashboard</h2>
        <ul>
            <!-- <li><a href="#">Dashboard</a></li> -->
            <li><a href="add_package.php">Manage Packages</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_booking.php">View Bookings</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
        <!-- Logout Button -->
        <form method="POST">
            <button type="submit" name="logout" class="btn">Logout</button>
        </form>
    </div>

   
    <div class="content">
        <h2>Greeting, Master</h2>

        <!-- Dashboard Cards -->
        <div class="card-container">
            <div class="card">
                <h3>Package Available</h3>
                <p>View, Add, or Edit Cars</p>
                <a href="add_package.php" class="btn">Manage Packages</a>
            </div>
            <div class="card">
                <h3>Registered Users</h3>
                <p>View, Add, or Edit Users</p>
                <a href="manage_users.php" class="btn">Manage Users</a>
            </div>
            <div class="card">
                <h3>Bookings</h3>
                <p>View Recent Bookings</p>
                <a href="manage_booking.php" class="btn">View Bookings</a>
            </div>
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
