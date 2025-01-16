<?php
// Database connection
$host = 'localhost'; 
$db = 'tourism'; 
$user = 'root'; 
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is passed in the URL
if (isset($_GET['id'])) {
    $package_id = intval($_GET['id']); // Get the ID from the URL

    // Check if the package exists
    $sql = "SELECT * FROM tourism_packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Package exists, proceed to delete
        $row = $result->fetch_assoc();
        $photo_url = $row['photo_url'];

        // Delete the package from the database
        $delete_sql = "DELETE FROM tourism_packages WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $package_id);

        if ($delete_stmt->execute()) {
            // Optionally, delete the photo file from the server
            if (file_exists($photo_url)) {
                unlink($photo_url);
            }
            echo "<script>alert('Package deleted successfully.'); window.location.href='adminPanel.php';</script>";
        } else {
            die("Error deleting package: " . $delete_stmt->error);
        }

        $delete_stmt->close();
    } else {
        echo "<script>alert('Package not found.'); window.location.href='add_package.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No package ID specified.'); window.location.href='add_package.php';</script>";
}

$conn->close();
?>
