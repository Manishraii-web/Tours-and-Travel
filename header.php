<?php
session_start(); // ✅ Start session
include "connection.php"; // Include database connection

$firstname = "Guest"; // Default name if no user is logged in

// Check if user is logged in
if (isset($_SESSION["user_id"])) {
    // Fetch user details from the database
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT firstname FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $firstname);

        if (!mysqli_stmt_fetch($stmt)) {
            $firstname = "Guest"; // If fetch fails, default to Guest
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover Zoom Navigation</title>
    <link rel="stylesheet" href="header.css">
    <style>
      .user-dropdown {
    position: relative;
    display: inline-block;
}

.user-dropdown a {
    text-decoration: none;
    color: #fff;
    padding: 10px 15px;
}

.user-dropdown .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #333;
    min-width: 150px;
    z-index: 1;
}

.user-dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu li {
    list-style: none;
    padding: 10px;
}

.dropdown-menu li a {
    text-decoration: none;
    color: white;
    display: block;
}

.dropdown-menu li a:hover {
    background-color: #555;
}

    </style>
</head>
<body>
    <div class="Heading">
        <div class="TOGETHER-name-logo">
            <div class="Logo">
                <img src="images/logoo.png" alt="logo">
            </div>
            <div class="web-name">
                <h1>Hamro Yatra</h1>
            </div>
        </div>
        <nav>
       <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact</a></li>
        <li><a href="admin/package.php">Packages</a></li>
        <li><a href="hotel.php">Hotels</a></li>

        <?php if (isset($_SESSION["user_id"])): ?>
            <li class="user-dropdown">
                <a href="#">👤 <?php echo htmlspecialchars($firstname); ?> ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="mybook.php">My Bookings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="sign_up.php">Sign Up</a></li>
        <?php endif; ?>
       </ul>
       </nav>

    </div>
</body>
</html>
