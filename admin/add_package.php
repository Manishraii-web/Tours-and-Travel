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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_package'])) {
    // Check if the necessary form fields are set
    if (isset($_POST['name'], $_FILES['image'], $_POST['price'], $_POST['description'], $_POST['package_type'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $package_type = $_POST['package_type']; 

        // Image upload handling
        $target_dir = "uploads/"; 
        $original_filename = basename($_FILES["image"]["name"]); 
        $unique_filename = uniqid() . "_" . $original_filename; // Using uniqid() for better uniqueness
        $target_file = $target_dir . $unique_filename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, a file with this name already exists.";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        $maxSize = 500000; // 500KB
        if ($_FILES["image"]["size"] > $maxSize) {
            echo "Sorry, your file is too large. Maximum size: " . ($maxSize / 1024) . "KB";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Store the full path of the uploaded image in the database
                $image_path = $target_dir . $unique_filename; 

                // Prepare the SQL query with placeholders
                $sql = "INSERT INTO packages (name, image_url, price, description, package_type) 
                        VALUES (?, ?, ?, ?, ?)";

                // Prepare and bind the statement
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("sssss", $name, $image_path, $price, $description, $package_type); 

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "New package added successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    echo "Error: Unable to prepare the SQL statement.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Error: Some required fields are missing.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Add Package</title>
    <link rel="stylesheet" href="add_package.css">
</head>
<body>
    <div class="container">
     <div class="header">
     <img src="uploads/logo.png" id="logo">
     <p id="para1">Yatra tours & <br>travels</p>
 
  </div>
        <h1>Add New Package</h1>

        <form action="add_package.php" method="POST" enctype="multipart/form-data"> 
            <input type="text" name="name" placeholder="Package Name" required><br>
            <input type="file" name="image" required><br>
            <input type="text" name="price" placeholder="Price" required><br>
            <textarea name="description" placeholder="Package Description" required></textarea><br> 
            <select name="package_type">
                <option value="top">Top Package</option>
                <option value="other">Other Package</option>
            </select><br>
            <button type="submit" name="add_package">Add Package</button>
        </form>
    </div>
</body>
</html>
