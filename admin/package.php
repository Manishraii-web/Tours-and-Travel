<?php

include "../header.php";
// Database connection
$host = 'localhost'; // Change to your host
$db = 'tourism'; // Change to your database name
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password
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
    <title>View Packages</title>
    <style>
    
        .package-container {
            width: 80%;
            margin: auto;
        }
        .package-category {
            margin-bottom: 20px;
        }
        .package {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            width: 250px;
            text-align: left;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .package img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .book-btn {
            display: block;
            width: 50%;
            padding: 10px;
            margin-top: 10px;
            margin-left:40px;
            text-align: center;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .book-btn:hover {
            background-color: #218838;
        }
        h2 {
            color: #444;
            text-align:center;
            margin-top:90px;
            margin-bottom:50px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Tourism Packages</h1>

    <div class="package-container">

        <!-- Display Top Packages -->
        <div class="package-category">
            <h2>🏆 Top Packages</h2>
            <?php
            if ($top_packages_result->num_rows > 0) {
                while ($row = $top_packages_result->fetch_assoc()) {
                    echo '<div class="package">';
                    echo '<img src="' . $row["photo_url"] . '" alt="Package Image">';
                    echo '<h3>' . $row["package_name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<p><strong>Price:</strong> $' . $row["price"] . '</p>';
                    echo '<a href="book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No Top Packages found.</p>";
            }
            ?>
        </div>

        <!-- Display Other Packages -->
        <div class="package-category">
            <h2>🌍 Other Packages</h2>
            <?php
            if ($other_packages_result->num_rows > 0) {
                while ($row = $other_packages_result->fetch_assoc()) {
                    echo '<div class="package">';
                    echo '<img src="' . $row["photo_url"] . '" alt="Package Image">';
                    echo '<h3>' . $row["package_name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<p><strong>Price:</strong> $' . $row["price"] . '</p>';
                    echo '<a href="book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No Other Packages found.</p>";
            }
            ?>
        </div>

    </div>
    <?php 
    include "../footer.php";
    ?>

</body>
</html>
