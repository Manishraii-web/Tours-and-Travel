<?php
// Start session handling at the very beginning


include "connection.php";

// Define variables
$email = $password = "";
$email_err = $password_err = $login_err = "";
$debug_messages = array(); // Array to store debug messages

// Function to log debug messages
function addDebug($message) {
    global $debug_messages;
    $debug_messages[] = $message . " [" . date('Y-m-d H:i:s') . "]";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addDebug("Form submitted");
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
        addDebug("Email field empty");
    } else {
        $email = trim($_POST["email"]);
        addDebug("Email provided: " . $email);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
        addDebug("Password field empty");
    } else {
        $password = trim($_POST["password"]);
        addDebug("Password provided (length): " . strlen($password));
    }

    // Authenticate user if no errors
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, firstname, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            addDebug("SQL statement prepared successfully");
            
            // Bind the email parameter
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            $row_count = mysqli_stmt_num_rows($stmt);
            addDebug("Number of matching users found: " . $row_count);

            // Check if email exists
            if ($row_count == 1) {
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $user_id, $firstname, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {
                    addDebug("User data fetched successfully");
                    
                    // Verify the password
                    if (password_verify($password, $hashed_password)) {
                        addDebug("Password verified successfully");
                        
                        // Start new session if not already started
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        
                        // Store session data
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["firstname"] = $firstname;
                        
                        addDebug("Session data set - User ID: " . $user_id);
                        addDebug("Session status: " . session_status());
                        addDebug("Session ID: " . session_id());
                        
                        // Redirect to homepage after successful login
                        header("Location: index.php");
                        exit();
                    } else {
                        $login_err = "Invalid email or password.";
                        addDebug("Password verification failed");
                    }
                }
            } else {
                $login_err = "Invalid email or password.";
                addDebug("No user found with provided email");
            }
            mysqli_stmt_close($stmt);
        } else {
            $login_err = "Something went wrong. Please try again later.";
            addDebug("SQL statement preparation failed: " . mysqli_error($conn));
        }
    }
}
mysqli_close($conn);

// Add debug information to the page if in development environment
$show_debug = true; // Set to false in production
?>

<?php include "header.php"; ?>

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
        <h1>Login</h1>
        <?php if (!empty($login_err)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($login_err); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="email-id">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280 320-200v-80L480-520 160-720v80l320 200Z"/>
                    </svg>
                </label>
                <input type="email" name="email" id="email-id" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div>
                <label for="password-id">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/>
                    </svg>
                </label>
                <input type="password" name="password" id="password-id" placeholder="Password" required>
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <button type="submit">Login Now</button>
        </form>
        
        <?php if ($show_debug && !empty($debug_messages)): ?>
            <div class="debug-section" style="margin-top: 20px; padding: 10px; background: #f5f5f5; border: 1px solid #ddd;">
                <h3>Debug Information:</h3>
                <pre style="white-space: pre-wrap;">
<?php foreach ($debug_messages as $message): ?>
    <?php echo htmlspecialchars($message) . "\n"; ?>
<?php endforeach; ?>
Session Info:
    Session Status: <?php echo session_status() ?>
    Session ID: <?php echo session_id() ?>
    Session Data: <?php print_r($_SESSION) ?>
                </pre>
            </div>
        <?php endif; ?>
        
        <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
        <p><a href="admin/adminlogin.php">Admin Login</a></p>
    </div>
</body>
</html>

<?php include "footer.php"; ?>