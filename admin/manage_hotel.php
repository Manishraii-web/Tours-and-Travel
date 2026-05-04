<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Dashboard</title>
    <!-- <link rel="stylesheet" href="dashboard.css">  -->
    <style>
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

/* Dashboard Container */
.dashboard-container {
    width: 95%;
    max-width: 1200px;
    margin: 20px auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Header */
header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

header h1 {
    color: #2c3e50;
    font-size: 28px;
    font-weight: 600;
}

/* Stats Section */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

/* Booking Table Section */
.manage-bookings {
    overflow-x: auto;
}

.manage-bookings h2 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-size: 22px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    background-color: coral;
}

table th, table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

table th {
    background-color: coral;
    color: white;
    font-weight: 600;
}

table tr:hover {
    background-color: #f9f9f9;
}

/* Table Links */
table a {
    color: #3498db;
    text-decoration: none;
    margin-right: 8px;
    transition: color 0.3s;
}

table a:hover {
    color: #2980b9;
    text-decoration: underline;
}

/* Delete Link */
table a[href*="delete"] {
    color: #e74c3c;
}

table a[href*="delete"]:hover {
    color: #c0392b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        width: 98%;
        padding: 15px;
    }
    
    table {
        font-size: 14px;
    }
    
    table th, table td {
        padding: 8px 10px;
    }
    
    header h1 {
        font-size: 24px;
    }
}

/* Fix for the table headers */
table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: coral;
}
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

/* Dashboard Container */
.dashboard-container {
    width: 95%;
    max-width: 1200px;
    margin: 20px auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Header */
header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

header h1 {
    color: #2c3e50;
    font-size: 28px;
    font-weight: 600;
}

/* Stats Section */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

/* Booking Table Section */
.manage-bookings {
    overflow-x: auto;
}

.manage-bookings h2 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-size: 22px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

table th, table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

table th {
    background-color: coral;
    color: white;
    font-weight: 600;
}

table tr:hover {
    background-color: #f9f9f9;
}

/* Table Links */
table a {
    color: #3498db;
    text-decoration: none;
    margin-right: 8px;
    transition: color 0.3s;
}

table a:hover {
    color: #2980b9;
    text-decoration: underline;
}

/* Delete Link */
table a[href*="delete"] {
    color: #e74c3c;
}

table a[href*="delete"]:hover {
    color: #c0392b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        width: 98%;
        padding: 15px;
    }
    
    table {
        font-size: 14px;
    }
    
    table th, table td {
        padding: 8px 10px;
    }
    
    header h1 {
        font-size: 24px;
    }
}

/* Fix for the table headers */
table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: coral;
}
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

/* Dashboard Container */
.dashboard-container {
    width: 95%;
    max-width: 1200px;
    margin: 20px auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Header */
header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

header h1 {
    color: #2c3e50;
    font-size: 28px;
    font-weight: 600;
}

/* Stats Section */
.stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

/* Booking Table Section */
.manage-bookings {
    overflow-x: auto;
}

.manage-bookings h2 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-size: 22px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

table th, table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

table th {
    background-color: coral;
    color: white;
    font-weight: 600;
}

table tr:hover {
    background-color: #f9f9f9;
}

/* Table Links */
table a {
    color: #3498db;
    text-decoration: none;
    margin-right: 8px;
    transition: color 0.3s;
}

table a:hover {
    color: #2980b9;
    text-decoration: underline;
}

/* Delete Link */
table a[href*="delete"] {
    color: #e74c3c;
}

table a[href*="delete"]:hover {
    color: #c0392b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        width: 98%;
        padding: 15px;
    }
    
    table {
        font-size: 14px;
    }
    
    table th, table td {
        padding: 8px 10px;
    }
    
    header h1 {
        font-size: 24px;
    }
}

/* Fix for the table headers */
table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: coral;
}
        </style>
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