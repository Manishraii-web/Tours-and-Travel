<?php
include "connection.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $package_id = $_POST["package_id"];
    $num_persons = $_POST["num_persons"];

    // Check if required fields are filled
    if (empty($user_id) || empty($package_id) || empty($num_persons)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    // Insert booking into the database
    $sql = "INSERT INTO booking (user_id, package_id, num_persons, booking_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $package_id, $num_persons);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}
?>
