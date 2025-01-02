<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$database = "tourism"; // Replace with your actual database name

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and Sanitize Input
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $booking_id = intval($_GET['id']); // Convert to integer for safety

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id); // Bind the parameter as an integer

    // Execute the query and check the result
    if ($stmt->execute()) {
        // Redirect to manage_booking.php on success
        header("Location: bookings.php?message=Booking deleted successfully");
        exit();
    } else {
        echo "Error deleting booking: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid booking ID.";
}

// Close the database connection
mysqli_close($conn);
?>
