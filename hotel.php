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