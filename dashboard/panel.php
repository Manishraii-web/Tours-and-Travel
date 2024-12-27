<?php
session_start(); 

// If the admin is not logged in, redirect to the login page
if (!isset($_SESSION['AdminLoginId'])) {
    header("Location: admin.php"); // Redirect to the admin login page
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Car Rental System</title>
    <link rel="stylesheet"  href="adminpanel.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <!-- <li><a href="#">Dashboard</a></li> -->
            <li><a href="add_car.php">Packages Manage</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="books.php">View Bookings</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
        <!-- Logout Button -->
        <form method="POST">
            <button type="submit" name="logout" class="btn">Logout Now</button>
        </form>
    </div>

   
    <div class="content">
        <h2>Welcome, Master!</h2>

        <!-- Dashboard Cards -->
        <div class="card-container">
            <div class="card">
                <h3>Packages Here</h3>
                <p>View, Add, or Edit Packages</p>
                <a href="add_car.php" class="btn">Manage Now</a>
            </div>

            <div class="card">
                <h3>Registered Users</h3>
                <p>View, Add, or Edit Users</p>
                <a href="manage_users.php" class="btn">Manage Users</a>
            </div>

            <div class="card">
                <h3>Bookings</h3>
                <p>View Recent Bookings</p>
                <a href="booking.php" class="btn">View Bookings</a>
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
