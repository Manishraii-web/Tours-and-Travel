<?php
require_once("database.php");
session_start(); 

// If the admin is already logged in, redirect to the admin panel
if (isset($_SESSION['AdminLoginId'])) {
    header("Location: panel.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Yatra's Admin Login</title>
    <link rel="stylesheet" href="adminlogin.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .login-conatiner {
            background-color: #333;
        }
        
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="title">Welcome MASTER!</h2>

        <form class="login-form" method="POST">
            <label for="admin">Login to Your Account</label>
            <input type="text" id="admin" name="AdminName" placeholder="Name" required>
            <input type="password" id="password" name="AdminPassword" placeholder="Password" required>
            <button type="submit" class="btn" name="Signin" value="login">Sign in</button>
        </form>

        <?php 
        // Process login when form is submitted
        if (isset($_POST["Signin"])) {
            $adminName = mysqli_real_escape_string($conn, $_POST["AdminName"]);
            $adminPassword = mysqli_real_escape_string($conn, $_POST["AdminPassword"]);

            // Prepare the SQL query to verify admin credentials
            $query = "SELECT * FROM `admin_login` WHERE `admin_name`='$adminName' AND `admin_password`='$adminPassword'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // Correct login, set session and redirect to admin panel
                $_SESSION['AdminLoginId'] = $adminName;
                header("Location: adminPanel.php");
                exit();
            } else {
                // Incorrect login details, show an error message
                echo "<p class='alert'>Incorrect username or password</p>";
            }
        }
        ?>
    </div>

</body>
</html>
