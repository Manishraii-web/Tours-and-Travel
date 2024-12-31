<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourism"; // Change this to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hotel data from database
$sql = "SELECT * FROM hotels"; // Assuming your table is named "hotels"
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking List</title>
    <link rel="stylesheet" href="hotel.css"> 
    <style>
        /* Basic Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        h1 {
            text-align: center;
            color: darkblue;
            margin-bottom: 30px;
        }

        /* Grid Layout for Hotel List */
        .hotel-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        /* Hotel Card Styles */
        .hotel-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        /* Hover Effect for Hotel Cards */
        .hotel-card:hover {
            transform: translateY(-5px);
        }

        /* Hotel Image Styling */
        .hotel-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Hotel Info Section */
        .hotel-info {
            padding: 15px;
        }

        /* Hotel Title */
        .hotel-info h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }

        /* Location and Price Text */
        .hotel-info p {
            margin: 5px 0;
            color: #666;
        }

        /* Price Styling */
        .hotel-info .price {
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
        }

        /* Button Styling */
        .hotel-info button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color:darkblue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        /* Hover Effect for Button */
        .hotel-info button:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hotel Booking List</h1>
        <div class="hotel-list">
            <?php
            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data for each hotel
                while ($row = $result->fetch_assoc()) {
                    $imagePath = 'uploads/' . $row['image_path']; 
                    echo '
                        <div class="hotel-card">
                            <img src="' . $imagePath . '" alt="Hotel Image" class="hotel-image">
                            <div class="hotel-info">
                                <h2>' . htmlspecialchars($row['hotel_name']) . '</h2>
                                <p>Location: ' . htmlspecialchars($row['location']) . '</p>
                                <p class="price">' . htmlspecialchars($row['price']) . ' rupees/night</p>
                                <button>Book Now</button>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "<p>No hotels found</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>