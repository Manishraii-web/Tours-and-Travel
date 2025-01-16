<?php
// Database connection
$host = 'localhost'; // Change to your host
$db = 'tourism'; // Change to your database name
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Capture input values
    $package_name = trim($_POST['package_name']);
    $description = trim($_POST['description']);
    $package_type = $_POST['package_type'];
    $price = floatval($_POST['price']); // Ensure price is stored as a number

    // Validate if required fields are filled
    if (empty($package_name) || empty($description) || empty($package_type) || empty($price)) {
        die("All fields are required.");
    }

    // Handle file upload
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        die("File upload failed. Error: " . $_FILES['photo']['error']);
    }

    $photo = $_FILES['photo']['name'];
    $target_dir = "img/";
    
    // Create uploads directory if it doesn't exist
    if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
        die("Failed to create upload directory.");
    }

    $target_file = $target_dir . basename($photo);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate image file
    if (!getimagesize($_FILES['photo']['tmp_name'])) {
        die("File is not a valid image.");
    }
    if ($_FILES['photo']['size'] > 5000000) { // 5MB max size
        die("File is too large. Max size is 5MB.");
    }
    if (!in_array($file_extension, $allowed_extensions)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        die("Error moving uploaded file.");
    }

    // Insert into database
    $sql = "INSERT INTO tourism_packages (package_name, description, package_type, price, photo_url) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("SQL preparation failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $package_name, $description, $package_type, $price, $target_file);
    
    if ($stmt->execute()) {
        echo "<script>alert('Your package has been added successfully!'); window.location.href='try_admin.php';</script>";
    } else {
        die("Error inserting data: " . $stmt->error);
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Package</title>
</head>
<body>
    <h1>Add Tourism Package</h1>
    <form action="add_package.php" method="POST" enctype="multipart/form-data">
        <label for="package_name">Package Name:</label>
        <input type="text" name="package_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="package_type">Package Type:</label>
        <select name="package_type" required>
            <option value="top">Top Package</option>
            <option value="other">Other Package</option>
        </select><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="photo">Photo:</label>
        <input type="file" name="photo" accept="image/*" required><br>

        <button type="submit" name="submit">Add Package</button>
    </form>
</body>
</html>
