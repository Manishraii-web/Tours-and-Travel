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

// Check if the search query is set
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Prepare the SQL query to fetch matching packages
    $sql = "SELECT id, package_name FROM tourism_packages WHERE package_name LIKE ? AND package_type = 'top' ORDER BY package_name LIMIT 2";
    $stmt = $conn->prepare($sql);
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    // Output suggestions
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="suggestion-item" data-id="' . $row["id"] . '">' . $row["package_name"] . '</div>';
        }
    } else {
        echo '<div>No suggestions found.</div>';
    }

    $conn->close();
}
?>
