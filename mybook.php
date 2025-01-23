<?php
include "connection.php"; // Database connection

// Ensure the user is logged in (if applicable) and fetch the user_id from session or other methods
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must log in to view your bookings.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

// Fetch booking details for the logged-in user, including the package price
$sql = "SELECT b.id AS booking_id, b.num_persons, b.booking_date, t.package_name, t.price
        FROM booking b
        JOIN tourism_packages t ON b.package_id = t.id
        WHERE b.user_id = ? ORDER BY b.booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind user_id
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* Header */
h1 {
    text-align: center;
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 20px;
}

/* Table Styles */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Table Header */
th {
    background-color: #007BFF;
    color: white;
    padding: 10px;
    text-align: left;
    font-size: 1.1rem;
}

/* Table Rows */
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Table Row Hover Effect */
tr:hover {
    background-color: #f1f1f1;
}

/* No Bookings Message */
p {
    text-align: center;
    font-size: 1.2rem;
    color: #555;
}

/* Back to Homepage Link */
a {
    display: inline-block;
    margin-top: 20px;
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    text-align: center;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h1>Your Bookings</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Package Name</th>
                    <th>Number of Persons</th>
                    <th>Booking Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['package_name']; ?></td>
                        <td><?php echo $row['num_persons']; ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo '$' . number_format($row['price'], 2); ?></td> <!-- Display the price -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no bookings yet.</p>
    <?php endif; ?>

    <a href="index.php">Back to Homepage</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
