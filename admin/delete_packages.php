<?php
$host = 'localhost';
$db = 'tourism';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);

    // Delete associated bookings first
    $sql = "DELETE FROM booking WHERE package_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $stmt->close();

    // Fetch the package image path
    $sql = "SELECT photo_url FROM tourism_packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $stmt->bind_result($photo_url);
    $stmt->fetch();
    $stmt->close();

    // Delete the package
    $sql = "DELETE FROM tourism_packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);

    if ($stmt->execute()) {
        // Delete image file
        if (file_exists($photo_url)) {
            unlink($photo_url);
        }
        echo "Package deleted successfully!";
    } else {
        echo "Error deleting package: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Invalid request!";
}

$conn->close();
?>
