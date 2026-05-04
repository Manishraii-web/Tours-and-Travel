<?php
// session_start();
include "header.php";
include "connection.php"; // Database connection

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Please log in to book a package.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user details
$user_sql = "SELECT firstname, email FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_stmt->bind_result($firstname, $email);
$user_stmt->fetch();
$user_stmt->close();

// Fetch package details
if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $package_sql = "SELECT * FROM tourism_packages WHERE id = ?";
    $package_stmt = $conn->prepare($package_sql);
    $package_stmt->bind_param("i", $package_id);
    $package_stmt->execute();
    $package_result = $package_stmt->get_result();

    if ($package_result->num_rows == 1) {
        $package = $package_result->fetch_assoc();
    } else {
        echo "<script>alert('Package not found.'); window.location.href='index.php';</script>";
        exit();
    }
    $package_stmt->close();
} else {
    echo "<script>alert('Invalid package selection.'); window.location.href='index.php';</script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Package</title>
    <link rel="stylesheet" href="book.css">
    <style>
        .booking-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin: 90px auto;
        }
        h1, h2, h3 { color: #333; }
        p { font-size: 16px; color: #555; }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .confirm-btn {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .confirm-btn:hover { background-color: #218838; }
    </style>
    <script>
        function calculateTotal() {
            let pricePerPerson = <?php echo $package['price']; ?>;
            let numPersons = document.getElementById("num_persons").value;
            let total = pricePerPerson * numPersons;
            document.getElementById("total_price").innerText = total;
            document.getElementById("total_amount").value = total;
        }
    </script>
</head>
<body>

    <div class="booking-container">
        <h1>Confirm Your Booking</h1>
        <div class="user-info">
            <h3>Booking Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>

        <div class="package-info">
            <h2><?php echo htmlspecialchars($package['package_name']); ?></h2>
            <p><?php echo htmlspecialchars($package['description']); ?></p>
            <p><strong>Price per person:</strong> Rs. <?php echo htmlspecialchars($package['price']); ?></p>
        </div>

        <form action="khalti/checkout.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($firstname); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="package" value="<?php echo htmlspecialchars($package['package_name']); ?>">

            <label for="travel_date">Travel Date:</label>
            <input type="date" id="travel_date" name="travel_date" required>

            <label for="num_persons">Number of Persons:</label>
            <input type="number" id="num_persons" name="num_persons" min="1" value="1" required oninput="calculateTotal()">

            <p><strong>Total Price:</strong> Rs. <span id="total_price"><?php echo htmlspecialchars($package['price']); ?></span></p>
            <input type="hidden" id="total_amount" name="amount" value="<?php echo htmlspecialchars($package['price']); ?>">

            <button type="submit" class="confirm-btn">Proceed to Checkout</button>
        </form>
    </div>

</body>
</html>

<?php include "footer.php"; ?>
