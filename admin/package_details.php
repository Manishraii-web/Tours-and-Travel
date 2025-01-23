<?php



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
<?php
session_start(); // ✅ Start session
include "../connection.php"; // Include database connection

$firstname = "Guest"; // Default name if no user is logged in

// Check if user is logged in
if (isset($_SESSION["user_id"])) {
    // Fetch user details from the database
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT firstname FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $firstname);

        if (!mysqli_stmt_fetch($stmt)) {
            $firstname = "Guest"; // If fetch fails, default to Guest
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover Zoom Navigation</title>
    <link rel="stylesheet" href="../header.css">
    <style>
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-dropdown a {
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
        }

        .user-dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 150px;
            z-index: 1;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu li {
            list-style: none;
            padding: 10px;
        }

        .dropdown-menu li a {
            text-decoration: none;
            color: white;
            display: block;
        }

        .dropdown-menu li a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="Heading">
        <div class="TOGETHER-name-logo">
            <div class="Logo">
                <img src="../logoo.png" alt="logo">
            </div>
            <div class="web-name">
                <h1>Hamro Yatra</h1>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact</a></li>
                <li><a href="admin/package.php">Packages</a></li>
                <li><a href="hotel.php">Hotels</a></li>

                <?php if (isset($_SESSION["user_id"])): ?>
                <li class="user-dropdown">
                    <a href="#">👤
                        <?php echo htmlspecialchars($firstname); ?> ▼
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="mybook.php">My Bookings</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="sign_up.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</body>

</html>

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


?>