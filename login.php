

<?php
// Database Connection
$servername = "localhost";
$username = "root";
$db_password = ""; // Your database password
$database = "tourism";

$conn = mysqli_connect($servername, $username, $db_password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); // Start session for user management

// Define variables
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Authenticate user if no errors
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, firstname, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the email parameter
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if email exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $firstname, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        // Verify the password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct; start a new session
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["firstname"] = $firstname;

                            // Show success popup and redirect
                            echo "<script>
                                    alert('Login successful! Welcome, " . htmlspecialchars($firstname) . "!');
                                    window.location.href = 'index.php';
                                  </script>";
                            exit();
                        } else {
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid email or password.";
                }
            } else {
                $login_err = "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <?php
        include"header.php"
        ?>
        <h1>Login</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="email-id">  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280 320-200v-80L480-520 160-720v80l320 200Z"/></svg></label>
                <input type="email" name="email" id="email-id" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                <span><?php echo $email_err; ?></span>
            </div>
            <div>
                <label for="password-id"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="http://www.w3.org/2000/svg" width="24px" fill="#5f6368"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg></label>
                <input type="password" name="password" id="password-id" placeholder="Password" required>
                <span><?php echo $password_err; ?></span>
            </div>
            <button type="submit">Login Now</button>
        </form>
        <p><?php echo $login_err; ?></p>
        <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
    </div>
</body>
</html>
<?php
include"footer.php"
?>
