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

// Handle hotel deletion
if (isset($_GET['delete'])) {
    $hotel_id = $_GET['delete'];

    // Delete the hotel from the database
    $stmt = $conn->prepare("DELETE FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);

    if ($stmt->execute()) {
        echo "<script>alert('Hotel deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting hotel: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Handle price update
if (isset($_POST['update_price'])) {
    $hotel_id = $_POST['hotel_id'];
    $new_price = $_POST['new_price'];

    // Update the price in the database
    $stmt = $conn->prepare("UPDATE hotels SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $new_price, $hotel_id);

    if ($stmt->execute()) {
        echo "<script>alert('Price updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating price: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Handle new hotel addition
if (isset($_POST['submit'])) {
    $hotel_name = trim($_POST['hotel_name']);
    $location = trim($_POST['location']);
    $price = $_POST['price'];

    // Image upload handling
    $target_dir = "uploads/"; // Directory to store uploaded images
    $target_file = $target_dir . basename($_FILES["hotel_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["hotel_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $uploadOk = 0;
    }

    $maxSize = 500000000; // 50MB
    if ($_FILES["hotel_image"]["size"] > $maxSize) {
        echo "<script>alert('Sorry, your file is too large. Maximum size: " . ($maxSize / 1024) . "KB');</script>";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["hotel_image"]["tmp_name"], $target_file)) {
            $image_path = basename($_FILES["hotel_image"]["name"]);

            // Prepared statement to insert data
            $stmt = $conn->prepare("INSERT INTO hotels (hotel_name, location, price, image_path) 
                                    VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $hotel_name, $location, $price, $image_path);

            if ($stmt->execute()) {
                echo "<script>alert('New hotel added successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
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
    <title>Hotel List & Add Form</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        form {
            border: 3px solid blue;
            padding: 10px;
            width: 400px;
            margin: auto;
            margin-top: 50px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: darkblue;
            color: white;
            padding: 6px;
            border-radius: 10px;
            width: 100%;
        }
        button:hover {
            background-color: blue;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-price-form input {
            padding: 5px;
            margin: 5px;
        }
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

        <label for="price">Price per Night:</label>
        <input type="number" id="price" name="price" required><br>

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
                <th>Price per Night</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all hotels from the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            $result = $conn->query("SELECT * FROM hotels");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['hotel_name'] . '</td>';
                    echo '<td>' . $row['location'] . '</td>';
                    echo '<td>' . $row['price'] . ' rupees/night</td>';
                    echo '<td><img src="uploads/' . $row['image_path'] . '" width="100" height="100"></td>';
                    echo '<td>';
                    echo '<a href="add_hotel.php?delete=' . $row['id'] . '" onclick="return confirmDelete()"><button>Delete</button></a>';
                    echo ' | ';
                    echo '<button onclick="showEditPriceForm(' . $row['id'] . ', ' . $row['price'] . ')">Edit Price</button>';
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

    <div id="editPriceForm" style="display:none;">
        <h3>Edit Price</h3>
        <form method="POST">
            <input type="hidden" id="hotel_id" name="hotel_id">
            <label for="new_price">New Price:</label>
            <input type="number" id="new_price" name="new_price" required>
            <button type="submit" name="update_price">Update Price</button>
        </form>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this hotel?');
        }

        function showEditPriceForm(hotelId, currentPrice) {
            document.getElementById('hotel_id').value = hotelId;
            document.getElementById('new_price').value = currentPrice;
            document.getElementById('editPriceForm').style.display = 'block';
        }
    </script>

</body>
</html>


