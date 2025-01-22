<?php
include "../header.php";

// Database connection
$host = 'localhost';
$db = 'tourism';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get package ID from URL
$package_id = $_GET['package_id'];

// Fetch package details
$sql = "SELECT * FROM tourism_packages WHERE id = $package_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["package_name"]; ?></title>
    <link rel="stylesheet" href="package_details.css"> 
    <style>
        .package img {
  width: 100%; 
  height: auto; 
  max-height: 200px; 
  object-fit: cover; 
  border-radius: 5px; 
  cursor: pointer;
  transition: transform 0.2s ease-in-out; 
}

.package img:hover {
  transform: scale(1.05); 
}
body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

h1 {
  text-align: center;
  margin-top: 30px;
  color: #333;
}

img {
  width: 100%;
  max-width: 500px;
  margin: 20px auto; 
  display: block; 
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
}

p {
  font-size: 16px;
  line-height: 1.5;
  color: #666;
  margin: 20px;
  text-align: center; 
}

.book-btn {
  display: block;
  width: 200px;
  margin: 20px auto;
  padding: 15px;
  background-color: #4CAF50;
  color: white;
  text-decoration: none;
  text-align: center;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.book-btn:hover {
  background-color: #3e8e41;
}
        </style>
</head>
<body>

    <h1><?php echo $row["package_name"]; ?></h1>
    <img src="<?php echo $row["photo_url"]; ?>" alt="Package Image" style="width: 100%; max-width: 500px;">
    <p><?php echo $row["description"]; ?></p>
    <p><strong>Price:</strong> Rs:<?php echo $row["price"]; ?></p>
    <a href="../book.php?package_id=<?php echo $row["id"]; ?>" class="book-btn">Book Now</a>

</body>
</html>

<?php
} else {
    echo "Package not found.";
}

$conn->close();
?>