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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="package.css">
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <img src="images/logo.png" id="logo" alt="Yatra Logo">
            <p id="para1">Yatra Tours & <br> Travels</p>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <li><a href="package.php">Packages</a></li>
                    <li><a href="hotel.php">Hotels</a></li>
                </ul>
            </nav>
        </header>

        <!-- All Packages Section -->
        <section>
            <h1 class="section-header">All Packages</h1>
            <div class="packages">
                <?php
                // Fetch all packages from the database
                $sql = "SELECT * FROM packages";
                $result = $conn->query($sql);

                // Check if packages are available and display them
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="image-container">
                            <a href="book.php?id=<?php echo $row['id']; ?>">
                                <!-- Display image and package details -->
                                <img src="admin/uploads/<?php echo htmlspecialchars($row['image_url']); ?>"
                                     alt="<?php echo htmlspecialchars($row['name']); ?>">
                                <p><?php echo htmlspecialchars($row['name']); ?></p>
                                <p class="price">Price: Rs <?php echo number_format($row['price'], 2); ?></p>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No packages available.</p>";
                }
                ?>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="foot">
            <div class="contact-info">
                <p><i class="fa-solid fa-envelope"></i> yatru@gmail.com</p>
                <p><i class="fa-brands fa-instagram"></i> Yatru_Official</p>
                <p><i class="fa-brands fa-square-facebook"></i> Yatra Tours & Hotels</p>
                <p><i class="fa-solid fa-phone"></i> +977-957689547</p>
            </div>
        </footer>
    </div>
</body>

</html>
