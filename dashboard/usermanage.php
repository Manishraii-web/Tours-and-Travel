<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatru's Passenger</title>
   <link rel="stylesheet"  href="usermanage.css">
</head>
<body>

<div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
    <a href="panel.php">
    <h2 style="color:white;">Dashboard</h2>
    </a>
        <ul>
            <li><a href="managepackage.php">Manage Packages</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="booking.php">View Bookings</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Manage Users</h1>

        <?php
        require 'database.php'; 

        // For deleting a user
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $delete_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('User deleted successfully.');</script>";
            } else {
                echo "<div class='alert'>Error occurred: " . mysqli_error($conn) . "</div>";
            }
        }

        // Fetch user data from the database
        $sql = "SELECT id, username, phone_number, email FROM users";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<thead><tr><th>S.N.</th><th>Username</th><th>Phone Number</th><th>Email</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            // Initialize serial number counter
            $serial_number = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td data-label='S.N.'>" . $serial_number++ . "</td>"; 
                echo "<td data-label='Username'>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td data-label='Phone Number'>" . htmlspecialchars($row['phone_number']) . "</td>";
                echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td data-label='Action'><a href='?delete_id=" . $row['id'] . "' class='btn' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert'>No users found.</div>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>
</div>

</body>
</html>
