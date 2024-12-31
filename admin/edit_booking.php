<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$database = "cwhdb"; // Replace with your actual database name

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get booking ID from URL and validate
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $booking_id = $_GET['id'];
} else {
    die("Invalid booking ID.");
}

// Fetch booking details
$sql = "SELECT * FROM book_table WHERE id = $booking_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $booking = mysqli_fetch_assoc($result);
} else {
    echo "Booking not found.";
    exit();
}

// Handle form submission to update booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $noofpeople = $_POST['noofpeople'];
    $dot = $_POST['dot'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    $update_sql = "UPDATE book_table SET 
                    name = '$name', 
                    noofpeople = '$noofpeople', 
                    dot = '$dot', 
                    phone = '$phone', 
                    country = '$country', 
                    message = '$message' 
                    WHERE id = $booking_id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: manage_booking.php");
        exit();
    } else {
        echo "Error updating booking: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="edit_booking.css"> 
</head>
<body>
    <h2>Edit Booking</h2>

    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($booking['name']) ?>"><br><br>

        <label for="noofpeople">No. of People:</label>
        <input type="number" name="noofpeople" id="noofpeople" value="<?= htmlspecialchars($booking['noofpeople']) ?>"><br><br>

        <label for="dot">Travel Date:</label>
        <input type="date" name="dot" id="dot" value="<?= htmlspecialchars($booking['dot']) ?>"><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($booking['phone']) ?>"><br><br>

        <label for="country">Country:</label>
        <input type="text" name="country" id="country" value="<?= htmlspecialchars($booking['country']) ?>"><br><br>

        <label for="message">Message:</label>
        <textarea name="message" id="message"><?= htmlspecialchars($booking['message']) ?></textarea><br><br>

        <button type="submit">Update Booking</button>
    </form>

</body>
</html>
