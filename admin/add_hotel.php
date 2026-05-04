<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourism"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle hotel deletion
if (isset($_GET['delete'])) {
    $hotel_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);
    if ($stmt->execute()) {
        echo "<script>alert('Hotel deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting hotel: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Handle new hotel addition
if (isset($_POST['submit'])) {
    $hotel_name = trim($_POST['hotel_name']);
    $location = trim($_POST['location']);
    $hotel_url = trim($_POST['hotel_url']);

    // Check if hotel name already exists
    $check_stmt = $conn->prepare("SELECT COUNT(*) as count FROM hotels WHERE hotel_name = ?");
    $check_stmt->bind_param("s", $hotel_name);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();
    $check_stmt->close();

    if ($row['count'] > 0) {
        // Hotel name already exists
        echo "<script>alert('A hotel with this name already exists. Please use a different name.');</script>";
    } else {
        // Image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["hotel_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["hotel_image"]["tmp_name"], $target_file)) {
            $image_path = basename($_FILES["hotel_image"]["name"]);
            $stmt = $conn->prepare("INSERT INTO hotels (hotel_name, location, hotel_url, image_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $hotel_name, $location, $hotel_url, $image_path);
            if ($stmt->execute()) {
                echo "<script>alert('New hotel added successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error uploading image.');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; text-align:center; }
        form { border: 3px solid coral; padding: 10px; width: 400px; margin: auto; margin-top: 50px; border-radius: 10px; }
        h1 { text-align: center; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 80%; padding: 8px; margin-bottom: 10px; border: 1px solid coral; border-radius: 5px; }
        button { background-color: coral; color: white; padding: 6px; border-radius: 10px; width: 50%; }
        button:hover { background-color: coral; }
        table { width: 100%; border-collapse: collapse; margin-top: 50px; }
        th, td { padding: 12px; text-align: left; border: 1px solid coral; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <!-- Add Hotel Form -->
    <form method="POST" action="add_hotel.php" enctype="multipart/form-data">
        <h1>Add New Hotel</h1>
        
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="hotel_url">Hotel Website URL:</label>
        <input type="url" id="hotel_url" name="hotel_url" required><br>

        <label for="hotel_image">Hotel Image:</label>
        <input type="file" id="hotel_image" name="hotel_image" required><br>

        <button type="submit" name="submit">Add Hotel</button>
    </form>

    <!-- Hotel List Table -->
    <h1 style="text-align: center;">Hotel List</h1>

    <table>
        <thead>
            <tr>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Image</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $result = $conn->query("SELECT * FROM hotels");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['hotel_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['location']) . '</td>';
                    echo '<td><img src="uploads/' . htmlspecialchars($row['image_path']) . '" width="100" height="100"></td>';
                    echo '<td><a href="' . htmlspecialchars($row['hotel_url']) . '" target="_blank">Visit Hotel</a></td>';
                    echo '<td>';
                    echo '<a href="add_hotel.php?delete=' . $row['id'] . '" onclick="return confirmDelete()"><button>Delete</button></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No hotels found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this hotel?');
        }
    </script>

</body>
</html>