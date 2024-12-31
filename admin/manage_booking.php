<?php
// Database Connection
$servername = "localhost";
$username = "root";
$db_password = ""; // Your database password
$database = "cwhdb"; // Replace with your actual database name

$conn = mysqli_connect($servername, $username, $db_password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch bookings from the database
$sql = "SELECT * FROM book_table ORDER BY dot ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching bookings: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        .manage-bookings {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <section class="manage-bookings">
            <h2>Manage Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Customer Name</th>
                        <th>No. of People</th>
                        <th>Travel Date</th>
                        <th>Phone Number</th>
                        <th>Country</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serial_number = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($booking = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($serial_number++) ?></td>
                                <td><?= htmlspecialchars($booking['name']) ?></td>
                                <td><?= htmlspecialchars($booking['noofpeople']) ?></td>
                                <td><?= htmlspecialchars($booking['dot']) ?></td>
                                <td><?= htmlspecialchars($booking['phone']) ?></td>
                                <td><?= htmlspecialchars($booking['country']) ?></td>
                                <td><?= htmlspecialchars($booking['message']) ?></td>
                                <td class="actions">
                                    <!-- Ensure correct URL format -->
                                    <a href="edit_booking.php?id=<?= urlencode($booking['id']) ?>">Edit</a>
                                    <a href="delete_booking.php?id=<?= urlencode($booking['id']) ?>" 
                                       onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>No bookings found.</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
