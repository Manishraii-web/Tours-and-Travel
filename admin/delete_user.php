<?php
// Database Connection
$servername = "127.0.0.1";  // Changed from 'localhost' to IP address
$username = "root";
$password = ""; // Your database password
$database = "tourism"; 

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // Validate and Sanitize Input
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $user_id = intval($_GET['delete']); // Convert to integer for safety
        
        // Prepare the DELETE query
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        
        // Execute the query and check the result
        if ($stmt->execute()) {
            header("Location: manage_user.php?message=User deleted successfully");
            exit();
        } else {
            throw new Exception("Error deleting User: " . $stmt->error);
        }
        
        $stmt->close();
    } else {
        throw new Exception("Invalid User ID.");
    }

} catch (Exception $e) {
    // Log the error and show user-friendly message
    error_log($e->getMessage());
    echo "An error occurred. Please try again later.";
    echo "<br>Error details: " . $e->getMessage();
} finally {
    // Close the database connection if it exists
    if (isset($conn) && $conn) {
        mysqli_close($conn);
    }
}
?>