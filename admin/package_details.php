<?php
include "headers.php";

// Database connection
$host = 'localhost';
$db = 'tourism';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get package ID from URL
$package_id = isset($_GET['package_id']) ? intval($_GET['package_id']) : 0;

if ($package_id == 0) {
    die("Invalid package ID.");
}

// Fetch package details from tourism_packages
$sql = "SELECT * FROM tourism_packages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();

if (!$package) {
    die("Package not found.");
}

// Fetch additional details from package_details
$sql_details = "SELECT * FROM package_details WHERE package_id = ?";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->bind_param("i", $package_id);
$stmt_details->execute();
$result_details = $stmt_details->get_result();
$package_details = $result_details->fetch_assoc();

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="package_details.css">
    <title><?php echo htmlspecialchars($package['package_name']); ?> - Details</title>
</head>
<body>

<div class="container">
    <div class="package-header">
        <img src="<?php echo htmlspecialchars($package['photo_url']); ?>" alt="Package Image">
        <h1><?php echo htmlspecialchars($package['package_name']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($package['description'])); ?></p>
        <p class="price">💰 Price: Rs. <?php echo number_format($package['price'], 2); ?></p>
        <p class="days">📅 Duration: <?php echo htmlspecialchars($package['days']); ?> Days</p>
        <a href="../book.php?package_id=<?php echo $package['id']; ?>" class="book-btn">Book Now</a>
    </div>

    <div class="tabs">
        <div class="tab active" onclick="showTab('cost-inclusion')">✔️ Cost Inclusions</div>
        <div class="tab" onclick="showTab('cost-exclusion')">❌ Cost Exclusions</div>
        <div class="tab" onclick="showTab('overview')">📖 Overview</div>
        <div class="tab" onclick="showTab('itinerary')">🗺️ Itinerary</div>
    </div>

    <div id="cost-inclusion" class="tab-content active">
        <h2>✔️ Cost Inclusions</h2>
        <p><?php echo isset($package_details['cost_include']) ? nl2br(htmlspecialchars($package_details['cost_include'])) : "No information available."; ?></p>
    </div>

    <div id="cost-exclusion" class="tab-content">
        <h2>❌ Cost Exclusions</h2>
        <p><?php echo isset($package_details['cost_exclude']) ? nl2br(htmlspecialchars($package_details['cost_exclude'])) : "No information available."; ?></p>
    </div>

    <div id="overview" class="tab-content">
        <h2>📖 Overview</h2>
        <p><?php echo isset($package_details['overview']) ? nl2br(htmlspecialchars($package_details['overview'])) : "No information available."; ?></p>
    </div>

    <div id="itinerary" class="tab-content">
        <h2>🗺️ Itinerary</h2>
        <p><?php echo isset($package_details['itinerary']) ? nl2br(htmlspecialchars($package_details['itinerary'])) : "No information available."; ?></p>
    </div>
</div>

<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        event.target.classList.add('active');
    }
</script>

</body>
</html>
