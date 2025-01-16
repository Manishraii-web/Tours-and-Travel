<?php
$hostname = "localhost"; 
$dbuser = "root";
$dbpassword = ""; 
$dbname = "tourism";

$conn = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
   
}
?>

<?php


$sql = "
    SELECT 
        (SELECT COUNT(*) FROM packages) AS total_packages, 
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM bookings) AS total_bookings
";


$result = $conn->query($sql);


if (!$result) {
   
    die("Query failed: " . $conn->error);
}


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_packages = $row['total_packages'];
    $total_users = $row['total_users']; 
    $total_bookings = $row['total_bookings'];
} else {
   
    $total_packages = 0; 
    $total_users = 0; 
    $total_bookings = 0; 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Car Rental System</title>
    <link rel="stylesheet" href="report.css"> 
</head>
<body>

<div class="main-content">
    <h2>Reports</h2>

    <!-- User Activity Report -->
    <div class="stats" style="font-weight: bold; color: black">
        <h3>Yatra's Tours and Travels Statistics</h3>
        <div class="circle-stats">
            <div class="circle">
                <p>Total Packages</p>
                <div class="count"><?php echo $total_packages; ?></div>
            </div>
            <div class="circle">
                <p>Total Users</p>
                <div class="count"><?php echo $total_users; ?></div> <!-- Displaying the total number of users -->
            </div>

            <div class="circle">
                <p>Total Bookings</p>
                <div class="count"><?php echo $total_bookings; ?></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>