<?php
session_start(); // Start the session

// Database connection
$host = 'localhost';
$db = 'tourism';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search term from the URL
$searchTerm = isset($_GET['search']) ? strtolower($_GET['search']) : '';

// Save the search term in the session
$_SESSION['search_term'] = $searchTerm;

// Query to fetch packages based on the search term
$top_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'top' AND LOWER(package_name) LIKE '%$searchTerm%' ORDER BY id DESC";
$top_packages_result = $conn->query($top_packages_sql);

// Query to fetch other packages based on the search term
$other_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'other' AND LOWER(package_name) LIKE '%$searchTerm%' ORDER BY id DESC";
$other_packages_result = $conn->query($other_packages_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Tourism Packages</title>
    <link rel="stylesheet" href="package.css">
</head>
<body>

    <h1>Search Results for: "<?php echo htmlspecialchars($searchTerm); ?>"</h1>

    <div class="package-container">
        <!-- Top Packages -->
        <div class="package-category">
            <h2>🏆 Top Packages</h2>
            <div class="package-grid">
                <?php
                if ($top_packages_result->num_rows > 0) {
                    while ($row = $top_packages_result->fetch_assoc()) {
                        echo '<div class="package">';
                        echo '<a href="package_details.php?package_id=' . $row["id"] . '">'; 
                        echo '<img src="' . $row["photo_url"] . '" alt="Package Image">';
                        echo '<h3>' . $row["package_name"] . '</h3>';
                        echo '<p>' . $row["description"] . '</p>';
                        echo '<p><strong>Price:</strong> Rs:' . $row["price"] . '</p>';
                        echo '<a href="book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No Top Packages found for this search term.</p>";
                }
                ?>
            </div>
        </div>

        <!-- Other Packages -->
        <div class="package-category">
            <h2>🌍 Other Packages</h2>
            <div class="package-grid">
                <?php
                if ($other_packages_result->num_rows > 0) {
                    while ($row = $other_packages_result->fetch_assoc()) {
                        echo '<div class="package">';
                        echo '<a href="package_details.php?package_id=' . $row["id"] . '">'; 
                        echo '<img src="' . $row["photo_url"] . '" alt="Package Image">';
                        echo '<h3>' . $row["package_name"] . '</h3>';
                        echo '<p>' . $row["description"] . '</p>';
                        echo '<p><strong>Price:</strong> Rs:' . $row["price"] . '</p>';
                        echo '<a href="book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No Other Packages found for this search term.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>
