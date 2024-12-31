manage_booking.php :<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <div class="stats">
            </div>

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
                    </tr>
                </thead>
                <tbody>
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
                    $sql = "SELECT * FROM book_table"; // Replace with your actual booking table name
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Error fetching bookings: " . mysqli_error($conn));
                    }

                    $serial_number = 1;
                    if (mysqli_num_rows($result) > 0) { 
                        while ($booking = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $serial_number++ ?></td>
                                <td><?= htmlspecialchars($booking['name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($booking['noofpeople'] ?? '') ?></td>
                                <td><?= htmlspecialchars($booking['dot'] ?? '') ?></td>
                                <td><?= htmlspecialchars($booking['phone'] ?? '') ?></td>
                                <td><?= htmlspecialchars($booking['country'] ?? '') ?></td>
                                <td><?= htmlspecialchars($booking['message'] ?? '') ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr><td colspan="7">No bookings found.</td></tr>
                    <?php }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>