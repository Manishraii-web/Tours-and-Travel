<?php
include "header.php"
?>

<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourism"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hotel data
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking List</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            margin-top:40px;
        }

        /* Hotel List */
        .hotel-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .hotel-card {
            width: 300px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            margin-bottom:60px;
        }

        .hotel-card:hover {
            transform: translateY(-10px);
        }

        .hotel-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .hotel-info {
            padding: 15px;
        }

        .hotel-info h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .hotel-info p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            font-size: 16px;
            font-weight: bold;
            color: #3b5998;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3b5998;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2a4373;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hotel Booking List</h1>
        <div class="hotel-list">
            <?php
            // Check if there are any hotels in the database
            if ($result->num_rows > 0) {
                // Output data of each hotel
                while($row = $result->fetch_assoc()) {
                    // Display each hotel as a card
                    echo '<div class="hotel-card">';
                    echo '<img src="admin/uploads/' . $row['image_path'] . '" alt="Hotel Image" class="hotel-image">';
                    echo '<div class="hotel-info">';
                    echo '<h2>' . $row['hotel_name'] . '</h2>';
                    echo '<p>Location: ' . $row['location'] . '</p>';
                    echo '<p class="price">' . $row['price'] . ' rupees/night</p>';
                    echo '<button>Book Now</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hotels available at the moment.</p>';
            }
            ?>
        </div>
    </div>

<?php
include"footer.php"
?>
</body>
</html>
