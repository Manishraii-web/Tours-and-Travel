<?php
// Database Connection
$hostname = "localhost"; 
$dbuser = "root";
$dbpassword = ""; 
$dbname = "tourism";

$conn = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch Total Counts
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM tourism_packages) AS total_packages, 
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM booking) AS total_bookings
";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Store Results
$row = $result->fetch_assoc();
$total_packages = $row['total_packages'] ?? 0; 
$total_users = $row['total_users'] ?? 0; 
$total_bookings = $row['total_bookings'] ?? 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Reports</title>
    <style>

        .dashboard {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .card {
            background: white;
            padding: 20px;
            width: 250px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .card .count {
            font-size: 30px;
            font-weight: bold;
            color: #007bff;
        }
        h1 {
            text-align: center;
            margin-top:20px;
        }
        h3 {
            text-align: center;
            margin-top:20px;

        }
    </style>
</head>
<body>

    <h1>Admin Dashboard - Reports</h1>
    <h3>Yatra's Tours and Travels Statistics</h3>

    <div class="dashboard">
        <div class="card" style="background-color color: white;">
            <h3>Total Users</h3>
            <div class="count"><?php echo $total_users; ?></div>
        </div>
        <div class="card" style="background-color: #28a745; color: white;">
            <h3>Total Packages</h3>
            <div class="count"><?php echo $total_packages; ?></div>
        </div>
        <div class="card" style="background-color: #dc3545; color: white;">
            <h3>Total Bookings</h3>
            <div class="count"><?php echo $total_bookings; ?></div>
        </div>
    </div>

</body>
</html>
