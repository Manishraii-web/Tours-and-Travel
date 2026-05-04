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

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    // Validation checks
    if (empty($firstname)) $errors[] = "First Name is required";
    if (empty($lastname)) $errors[] = "Last Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid Email is required";
    if (empty($password)) $errors[] = "Password is required";
    if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters";
    if ($password !== $cpassword) $errors[] = "Passwords do not match";

    if (empty($errors)) {
        // Secure input data
        $firstname = mysqli_real_escape_string($conn, $firstname);
        $lastname = mysqli_real_escape_string($conn, $lastname);
        $email = mysqli_real_escape_string($conn, $email);

        // Check if email already exists
        $checkEmail = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email is already registered";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert data into the database
            $sql = "INSERT INTO users (firstname, lastname, email, password, datetime) 
                    VALUES ('$firstname', '$lastname', '$email', '$hashed_password', NOW())";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn);
                $_SESSION['firstname'] = $firstname;
                
                // Redirect to the welcome page
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <?php include "header.php"; ?>
        <div class="top">
            <h1>SIGNUP</h1>
            <?php if (!empty($errors)) { ?>
                <div id="error-message">
                    <ul>
                        <?php foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
                    </ul>
                </div>
            <?php } ?>
            <form method="POST" id="form" action="sign_up.php">
                <div>
                    <input type="text" name="firstname" id="first_name" placeholder="Firstname" value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>">
                </div>
                <div>
                    <input type="text" name="lastname" id="last_name" placeholder="Lastname" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
                </div>
                <div>
                    <input type="email" name="email" id="email_id" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div>
                    <input type="password" name="password" id="password_id" placeholder="Password">
                </div>
                <div>
                    <input type="password" name="cpassword" id="cpassword_id" placeholder="Confirm-Password">
                </div>
                <button type="submit">Sign-up here</button>
            </form>
            <p>Already have an Account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
<?php include "footer.php"; ?>