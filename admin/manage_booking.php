<?php
include "../connection.php"; // Database connection

// Fetch all bookings with user and package details
$sql = "SELECT 
            b.id AS booking_id, 
            u.firstname AS user_name, 
            u.email AS user_email, 
            t.package_name, 
            t.price, 
            b.num_persons, 
            b.booking_date 
        FROM booking b
        JOIN users u ON b.user_id = u.id
        JOIN tourism_packages t ON b.package_id = t.id
        ORDER BY b.booking_date DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Bookings</title>
    <link rel="stylesheet" href="admin.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .booking-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <div class="booking-container">
        <h1>All Bookings</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Package Name</th>
                        <th>Price (Rs.)</th>
                        <th>No. of Persons</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['booking_id']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['package_name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['num_persons']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center;">No bookings found.</p>
        <?php endif; ?>

    </div>

</body>
</html>

