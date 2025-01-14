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
        <?php
        include"header.php"
        ?>

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
                            <img src="uploads<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                onerror="this.src='images/no-image.jpg'"> 
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
                            <img src="admin/uploads/<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" 
                                onerror="this.src='images/no-image.jpg'"> 
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                            <p class="price">Price: Rs <?php echo number_format($row['price'], 2); ?></p> 
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No other packages available.</p>
            <?php endif; ?>
        </div>
          <?php
          include"footer.php"
          ?>
    </div>
</body>

</html>