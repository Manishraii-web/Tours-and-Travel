<?php
session_start(); // ✅ Start session
include "../connection.php"; 

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
body {
    margin: 0;
    font-family: Arial, sans-serif;
}
.Heading {
    background-color: rgba(247, 111, 47, 0.5);
    padding: 20px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.TOGETHER-name-logo {
    display: flex;
    align-items: center;
}
.Logo img {
    width: 75px;
    height: auto;
}
.web-name h1 {
    font-size: 25px;
    margin-left: 15px;
    color: #333;
}

nav ul {
    display: flex;
    gap: 45px;
    list-style: none;
    padding: 0;
    margin: 0;
    align-items: center;
}

nav ul li a {
    color: black;
    text-decoration: none;
    font-weight: bold;
    font-size: 20px;
    position: relative;
    display: inline-block;
    transition: transform 0.3s ease, color 0.3s ease;
}

nav ul li a:hover {
    transform: scale(1.2); /* Zoom effect */
    color: rgb(134, 49, 10); 
}
/* Optional underline effect on hover */
nav ul li a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0;
    height: 3px;
    background-color: #f76f2f;
    transition: width 0.3s ease;
}
nav ul li a:hover::after {
    width: 100%;
}
/* Style for the user info */
.user-info {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}
.logout-btn {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}
.logout-btn:hover {
    background-color: #c9302c;
}

    </style>
</head>
<body>
    <div class="Heading">
        <div class="TOGETHER-name-logo">
            <div class="Logo">
                <img src="../logoo.png" alt="logo">
            </div>
            <div class="web-name">
                <h1>Hamro Yatra</h1>
            </div>
        </div>
        <nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../aboutus.php">About us</a></li>
        <li><a href="../contactus.php">Contact</a></li>
        <li><a href="package.php">Package</a></li>
        <li><a href="../hotel.php">HOtels</a></li>

        <?php if (isset($_SESSION["user_id"])): ?>
            <li class="user-dropdown">
                <a href="#">👤 <?php echo htmlspecialchars($firstname); ?> ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="../mybook.php">My Booking</a></li>
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
