<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=/, initial-scale=1.0">
    <title>SignUP</title>
    
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Database password
    $database = "cwhdb";

    // Establish database connection
    $conn = mysqli_connect($servername, $username, $db_password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape input to prevent SQL injection
    $firstname = mysqli_real_escape_string($conn, $firstname);
    $lastname = mysqli_real_escape_string($conn, $lastname);
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Get the current timestamp
    $current_datetime = date("Y-m-d H:i:s");

    // SQL query to insert data
    $sql = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `datetime`) 
            VALUES ('$firstname', '$lastname', '$email', '$hashed_password', '$current_datetime')";

    // Execute the query and handle errors
    if (mysqli_query($conn, $sql)) {
        echo "<p>Registration successful!</p>";
    } else {
        echo "<p>Error inserting data: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

 
    <div class="head">
        <img src="images/logo.png" id="logo">
        <p id="para1">Yatra tours & <br>travels</p>
    </div>
    <div class="top">
        <h1>SIGNUP</h1>
        <p id="error-message"></p>
        <form method="POST" id="form" action="signup.php">
            <div>
                <label for="first-name">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>  
                </label>
                <input type="text" name="firstname" id="first_name" placeholder="Firstname" > 
            </div>
            <div>
                <label for="last-name">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>     
                </label>
                <input type="text" name="lastname" id="last_name" placeholder="Lastname" > 
            </div>
            <div>
                <label for="email-id">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280 320-200v-80L480-520 160-720v80l320 200Z"/></svg>
                </label>
                <input type="email" name="email" id="email_id" placeholder="Email"> 
            </div>
            <div>
                <label for="password-id"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>

                </label>
                <input type="password" name="password" id="password_id" placeholder="Password" > 
            </div>
            <div>
                <label for="cpassword-id">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
                </label>
                <input type="password" name="cpassword" id="cpassword_id" placeholder="Confirm-Password" > 
            </div>
            <button type="submit">Sign-up here</button>
        </form>
        <p>Already have an Account ? <a href="login.html">Login here</a> </p>
    </div> 
    <div class="footer"></div>
   <script>
        const form = document.getElementById('form');
        const first_name = document.getElementById('first_name');
        const last_name = document.getElementById('last_name');
        const email = document.getElementById('email_id');
        const password = document.getElementById('password_id');
        const cpassword = document.getElementById('cpassword_id');
        const error_message = document.getElementById('error-message');

        form.addEventListener('submit', (e) => {
            let errors = [];

            // Validation logic
            if (!first_name.value) {
                errors.push("First Name is required");
                first_name.focus();
            }
            if (!last_name.value) {
                errors.push("Last Name is required");
                last_name.focus();
            }
            if (!email.value || !email.value.includes('@')) {
                errors.push("Valid Email is required");
                email.focus();
            }
            if (!password.value) {
                errors.push("Password is required");
                password.focus();
            }
            if (password.value !== cpassword.value) {
                errors.push("Passwords do not match");
                cpassword.focus();
            }

            if (errors.length > 0) {
                e.preventDefault();
                error_message.innerText = errors.join(". ");
            } else {
                error_message.innerText = '';
            }
        });
    </script>
</body>
</html>