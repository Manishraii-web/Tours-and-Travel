<?php
// Include header file
include "header.php";

// Include database connection
include "connection.php";

// Query to count the number of top packages
$count_sql = "SELECT COUNT(*) AS total_top_packages FROM tourism_packages WHERE package_type = 'top'"; 
$count_result = $conn->query($count_sql);

if ($count_result) {
    $count_row = $count_result->fetch_assoc();
    $total_top_packages = $count_row['total_top_packages'];
} else {
    // If error fetching count
    die("Error fetching total top packages: " . $conn->error);
}

// Query to fetch the top 4 packages
$sql = "SELECT * FROM tourism_packages WHERE package_type = 'top' LIMIT 4"; // Adjust based on your column
$top_packages_result = $conn->query($sql);

// Check if the query returned any results
if (!$top_packages_result) {
    die("Error fetching top packages: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .sign {
            /* Add specific styles here if necessary */
        }
        .package {
            display: inline-block;
            width: 250px;
            margin: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .package img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .book-btn {
            display: inline-block;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            margin-top: 15px;
        }
        .book-btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="hero">
            <h1>Dream Larger<br>Travel Smarter</h1>
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="Search here">
            </div>
        </div>

        <div class="section-header">
            <h1>TOP PACKAGES</h1>
            <p>Total Top Packages: <?php echo $total_top_packages; ?></p>
        </div>

        <div class="package-category">
            <h2>🏆 Top Packages</h2>
            <?php
            // Check if there are any packages fetched
            if ($top_packages_result->num_rows > 0) {
                // Loop through and display the packages
                while ($row = $top_packages_result->fetch_assoc()) {
                    echo '<div class="package">';
                    // Check and display the image, assuming photo_url stores the relative path
                    if (!empty($row["photo_url"])) {
                        echo '<img src="' . htmlspecialchars($row["photo_url"]) . '" alt="Package Image">';
                    } else {
                        // Display a default image if photo_url is empty
                        echo '<img src="admin/img/default-image.jpg" alt="Package Image">';
                    }
                    echo '<h3>' . htmlspecialchars($row["package_name"]) . '</h3>'; 
                    echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                    echo '<p><strong>Price:</strong> Rs ' . htmlspecialchars($row["price"]) . '</p>';
                    echo '<a href="book.php?package_id=' . htmlspecialchars($row["id"]) . '" class="book-btn">Book Now</a>';
                    echo '</div>';
                }
            } else {
                // If no packages found
                echo "<p>No Top Packages found.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();

// Include footer file
include "footer.php";
?>
