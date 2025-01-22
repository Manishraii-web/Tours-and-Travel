<?php

include "../header.php";
// Database connection
$host = 'localhost';
$db = 'tourism';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch top packages
$top_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'top' ORDER BY id DESC";
$top_packages_result = $conn->query($top_packages_sql);

// Fetch other packages
$other_packages_sql = "SELECT * FROM tourism_packages WHERE package_type = 'other' ORDER BY id DESC";
$other_packages_result = $conn->query($other_packages_sql);

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

    <h1>Welcome to your Destination ! </h1>

    <div class="package-container">

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
                        echo '</div>';
                    }
                } else {
                    echo "<p>No Top Packages found.</p>";
                }
                ?>
            </div>
        </div>

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
                        echo '<p><strong>Price:</strong> $' . $row["price"] . '</p>';
                        echo '<a href="../book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
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