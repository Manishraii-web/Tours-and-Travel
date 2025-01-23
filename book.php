<?php
include "header.php";
include "connection.php"; // Database connection



// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Please log in to book a package.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user details
$user_sql = "SELECT firstname, email FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_stmt->bind_result($firstname, $email);
$user_stmt->fetch();
$user_stmt->close();

// Fetch package details
if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $package_sql = "SELECT * FROM tourism_packages WHERE id = ?";
    $package_stmt = $conn->prepare($package_sql);
    $package_stmt->bind_param("i", $package_id);
    $package_stmt->execute();
    $package_result = $package_stmt->get_result();

    if ($package_result->num_rows == 1) {
        $package = $package_result->fetch_assoc();
    } else {
        echo "<script>alert('Package not found.'); window.location.href='index.php';</script>";
        exit();
    }
    $package_stmt->close();
} else {
    echo "<script>alert('Invalid package selection.'); window.location.href='index.php';</script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Package</title>
    <link rel="stylesheet" href="book.css"> <!-- Link to the CSS file -->
</head>
<body>

    <div class="booking-container">
        <h1>Confirm Your Booking</h1>

        <div class="package-info">
            <!-- <img src="<?php echo htmlspecialchars($package['photo_url']); ?>" alt="Package Image"> -->
            <h2><?php echo htmlspecialchars($package['package_name']); ?></h2>
            <p><?php echo htmlspecialchars($package['description']); ?></p>
            <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($package['price']); ?></p>
        </div>

        <div class="user-info">
            <h3>Booking Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>

       <form action="process_booking.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
    <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">

    <label for="num_persons">Number of Persons:</label>
    <input type="number" id="num_persons" name="num_persons" min="1" required>

    <button type="submit" class="confirm-btn">Confirm Booking</button>
</form>


    </div>

</body>
</html>

<?php include "footer.php"; ?>
