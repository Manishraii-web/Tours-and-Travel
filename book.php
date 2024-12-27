<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra Tours & Travels</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="book.css">
</head>

<body>

   <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if($_SERVER['REQUEST_METHOD'] =='POST') {

    $name = $_POST['name'] ?? '';
    $noofpeople = $_POST['noofpeople'] ?? '';
    $dot= $_POST['dot'] ?? '';
    $phone= $_POST['phone'] ?? '';
    $country= $_POST['country'] ?? '';
    $message= $_POST['message'] ?? '';

    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Database password
    $database = "cwhdb";

    $conn = mysqli_connect($servername, $username, $db_password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($conn, $name);
    $noofpeople = mysqli_real_escape_string($conn, $noofpeople);
    $dot = mysqli_real_escape_string($conn, $dot);
    $phone = mysqli_real_escape_string($conn, $phone);
    $country = mysqli_real_escape_string($conn, $country);
    $message = mysqli_real_escape_string($conn, $message);

    $current_datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `book_table` (`name`, `noofpeople`, `dot`, `phone`, `country`,`message`,`datetime`) 
    VALUES ('$name', '$noofpeople', '$dot', '$phone','$country','$message', '$current_datetime')";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Registration successful!</p>";
    } else {
        echo "<p>Error inserting data: " . mysqli_error($conn) . "</p>";
    }

    // Close the database connection
    mysqli_close($conn);

    }


   ?>

    <div class="header">
        <img src="images/logo.png" alt="Logo">
        <p id="para1">Yatra Tours & <br> Travels</p>
    </div>

    <div class="mid-body">
        <div class="form-container">
            <h2>Book Your Trip</h2>
            <form action="#" method="post" name="form">
                <label for="name">Full Name</label>
                <input type="text" id="name"  name ="name" placeholder="Your name" required>

                <label for="people">No. of People</label>
                <input type="number" name="noofpeople" id="people" placeholder="Total people" required>

                <label for="dot">Date of Travel</label>
                <input type="date" name="dot" id="dot" required>

                <label for="phone">Phone No.:</label>
                <div style="display: flex; gap: 5px;">
                    <select id="country-code">
                        <option value="+977">+977</option>
                        <option value="+001">+001</option>
                        <option value="+860">+860</option>
                    </select>
                    <input type="tel" name="phone" id="phone" placeholder="Your number" required>
                </div>

                <label for="country">Nationality</label>
                <select id="country" name="country">
                    <option value="">Select your Country</option>
                    <option value="US">United States</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Nepal">Nepal</option>
                    <option value="India">India</option>
                </select>

                <label for="message">More Information</label>
                <textarea id="message"  name="message" rows="4" placeholder="Additional details..."></textarea>

                <button type="submit" class="register">Book Now</button>
            </form>
        </div>
    </div>

    <div class="contact-info">
        <p> <i class="fa-solid fa-envelope"></i> yatru@gmail.com</p>
        <p><i class="fa-brands fa-instagram"></i> Yatru_Official</p>
        <p><i class="fa-brands fa-square-facebook"></i> Yatra Tours&Hotels</p>
        <p><i class="fa-solid fa-phone"></i> +977-957689547</p>
                
    </div>
    </div>
</body>

</html>