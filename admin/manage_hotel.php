<!DOCTYPE html>
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
            <h1>Manage Booking</h1>
        </header>

        <div class="stats">
            </div>

        <section class="manage-bookings">
            <!-- <h2>Manage Bookings</h2> -->
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
                    // Database Connection
                    $servername = "localhost";
                    $username = "root";
                    $password = ""; // Your database password
                    $database = "cwhdb"; // Replace with your actual database name

                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch bookings from the database
                    $sql = "SELECT * FROM book_table"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $serial_number = 1;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $serial_number++; ?></td>
                                <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                <td><?php echo htmlspecialchars($row["noofpeople"]); ?></td>
                                <td><?php echo htmlspecialchars($row["dot"]); ?></td>
                                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                                <td><?php echo htmlspecialchars($row["country"]); ?></td>
                                <td><?php echo htmlspecialchars($row["message"]); ?></td>
                                <td>
                                    <a href="edit_booking.php?id=<?php echo urlencode($row["id"]); ?>">Edit</a> | 
                                    <a href="delete_booking.php?id=<?php echo urlencode($row["id"]); ?>" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr><td colspan="8">No bookings found.</td></tr>
                    <?php }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>