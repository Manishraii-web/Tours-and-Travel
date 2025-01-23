<?php
include "headers.php";

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

// Query to fetch top packages based on the search term
$top_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'top' AND LOWER(package_name) LIKE ? ORDER BY id DESC";
$searchTermWithWildcards = "%$searchTerm%";
$top_packages_stmt = $conn->prepare($top_packages_sql);
$top_packages_stmt->bind_param("s", $searchTermWithWildcards);
$top_packages_stmt->execute();
$top_packages_result = $top_packages_stmt->get_result();

// Query to fetch other packages based on the search term
$other_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'other' AND LOWER(package_name) LIKE ? ORDER BY id DESC";
$other_packages_stmt = $conn->prepare($other_packages_sql);
$other_packages_stmt->bind_param("s", $searchTermWithWildcards);
$other_packages_stmt->execute();
$other_packages_result = $other_packages_stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="package.css">
</head>
<body>

    <h1>Welcome to your Destination!</h1>

    <div class="package-container">
        <!-- Top Packages Section -->
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
                        echo '<a href="../book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No Top Packages found.</p>";
                }
                ?>
            </div>
        </div>

        <!-- Other Packages Section -->
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
                        echo '<a href="../book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No Other Packages found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include "../footer.php";
    ?>

</body>
</html>
