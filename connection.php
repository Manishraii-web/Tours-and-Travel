<?php  
// Database connection details
$servername = "localhost";
$username = "root";
$db_password = ""; // Database password
$database = "tourism";

// Enable error reporting during development
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish database connection
    $conn = mysqli_connect($servername, $username, $db_password, $database);
} catch (Exception $e) {
    error_log("Connection failed: " . $e->getMessage()); // Log the error
    echo "We are experiencing technical difficulties. Please try again later.";
}

// Remember to close the connection when done
// mysqli_close($conn);
?>
