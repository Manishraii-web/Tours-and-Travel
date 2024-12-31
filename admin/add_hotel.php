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

if (isset($_POST['submit'])) {
    // Collect form data
    $hotel_name = trim($_POST['hotel_name']);
    $location = trim($_POST['location']);
    $price = $_POST['price'];

    // Image upload handling
    $target_dir = "uploads/"; // Directory to store uploaded images
    $target_file = $target_dir . basename($_FILES["hotel_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["hotel_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    $maxSize = 500000; // 500KB
    if ($_FILES["hotel_image"]["size"] > $maxSize) {
        echo "Sorry, your file is too large. Maximum size: " . ($maxSize / 1024) . "KB";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["hotel_image"]["tmp_name"], $target_file)) {
            // Store the relative path of the uploaded image in the database
            $image_path = basename($_FILES["hotel_image"]["name"]);

            // Insert data into database
            $sql = "INSERT INTO hotels (hotel_name, location, price, image_path) 
                    VALUES ('$hotel_name', '$location', '$price', '$image_path')"; 

            if ($conn->query($sql) === TRUE) { 
                echo "<p style='color: green;'>New hotel added successfully!</p>";
            } else {
                echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            $error = error_get_last();
            echo "Upload failed: " . $error['message'];
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
    <title>Add Hotel</title>
</head>
<body>
    <h1>Add New Hotel</h1>
    <form method="POST" action="add_hotel.php" enctype="multipart/form-data">
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" id="hotel_name" name="hotel_name" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="price">Price per Night:</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="hotel_image">Hotel Image:</label>
        <input type="file" id="hotel_image" name="hotel_image" required><br><br>

        <button type="submit" name="submit">Add Hotel</button>
    </form>
</body>
</html>