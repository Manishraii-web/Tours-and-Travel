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
        <div class="header">
            <img src="images/logo.png" id="logo">
            <p id="para1">Yatra tours & <br>travels</p>
            <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="package.html">Packages</a></li> 
                </ul>
            </nav>
        </div>

        <div class="section-header">
            <h1>TOP PACKAGES</h1>
        </div>
        <div class="packages">
            <?php
            // Fetch top packages
            $sql_top = "SELECT * FROM packages WHERE package_type = 'top'";
            $result_top = $conn->query($sql_top);

            if ($result_top->num_rows > 0) : ?>
                <?php while ($row = $result_top->fetch_assoc()) : ?>
                    <div class="image-container">
                        <a href="book.php?package_name=<?php echo urlencode($row['name']); ?>"> 
                            <?php if (file_exists($row['image_url'])) : ?>
                                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                onerror="this.src='images/no-image.jpg'"> 
                            <?php else : ?>
                                <p>Image not found.</p>
                            <?php endif; ?>
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                            <p class="price">Price: Rs <?php echo number_format($row['price'], 2); ?></p> 
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No top packages available.</p>
            <?php endif; ?>
        </div>

        <div class="section-header">
            <h1>OTHER PACKAGES</h1>
        </div>
        <div class="packages">
            <?php
            // Fetch other packages
            $sql_other = "SELECT * FROM packages WHERE package_type = 'other'";
            $result_other = $conn->query($sql_other);

            if ($result_other->num_rows > 0) : ?>
                <?php while ($row = $result_other->fetch_assoc()) : ?>
                    <div class="image-container">
                        <a href="book.php?package_name=<?php echo urlencode($row['name']); ?>"> 
                            <?php if (file_exists($row['image_url'])) : ?>
                                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                onerror="this.src='images/no-image.jpg'"> 
                            <?php else : ?>
                                <p>Image not found.</p>
                            <?php endif; ?>
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                            <p class="price">Price: Rs <?php echo number_format($row['price'], 2); ?></p> 
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No other packages available.</p>
            <?php endif; ?>
        </div>

        <div class="foot ">
            <div class="contact-info">
                <p> <i class="fa-solid fa-envelope"></i> yatru@gmail.com</p>
                <p><i class="fa-brands fa-instagram"></i> Yatru_Official</p>
                <p><i class="fa-brands fa-square-facebook"></i> Yatra Tours&Hotels</p>
                <p><i class="fa-solid fa-phone"></i> +977-957689547</p>
            </div>
        </div>
    </div>
</body>

</html>