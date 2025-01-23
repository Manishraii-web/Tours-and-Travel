<?php
$host = 'localhost'; 
$db = 'tourism'; 
$user = 'root'; 
$pass = ''; 
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
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];

    // Validate image file
    if (!getimagesize($_FILES['photo']['tmp_name'])) {
        die("File is not a valid image.");
    }
    if ($_FILES['photo']['size'] > 5000000) { // 5MB max size
        die("File is too large. Max size is 5MB.");
    }
    if (!in_array($file_extension, $allowed_extensions)) {
        die("Only JPG, JPEG, PNG,  and GIF files are allowed.");
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
        echo "<script>alert('Your package has been added successfully!'); window.location.href='adminPanel.php';</script>";
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
    <!-- <link rel="stylesheet" href="add_package.css"> -->
     <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
    color: #333;
}

form {
    width: 50%;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.add {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    font-size: 16px;
    margin-top: 15px;
    cursor: pointer;
    border-radius: 5px;
}

.add:hover {
    background-color: #218838;
}

/* Table Styling */
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}

th {
    background-color: #28a745;
    color: white;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn:hover {
    background-color: #c82333;
}
</style>
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

        <button type="submit" name="submit" class="add">Add Package</button>
    </form>
    <?php
// Place this code before the closing </body> tag

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tourism_packages ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Package Type</th>
                    <th>Price</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['package_name']) . '</td>
                <td>' . htmlspecialchars($row['description']) . '</td>
                <td>' . htmlspecialchars($row['package_type']) . '</td>
                <td>$' . number_format($row['price'], 2) . '</td>
                <td><img src="' . htmlspecialchars($row['photo_url']) . '" width="100"></td>
                <td>
                    <a href="delete_packages.php?id=' . $row['id'] . '" class="delete-btn" 
                       onclick="return confirm(\'Are you sure you want to delete this package?\')">Delete</a>
                </td>
            </tr>';
    }
    
    echo '</tbody></table>';
} else {
    echo '<p style="text-align: center; margin: 20px;">No packages found</p>';
}

$conn->close();
?>
</body>
</html>
