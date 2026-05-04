<?php
$host = 'localhost'; 
$db = 'tourism'; 
$user = 'root'; 
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    
    // Join the main package table with the details table
    $sql = "SELECT p.*, pd.cost_include, pd.cost_exclude, pd.overview, pd.itinerary 
            FROM tourism_packages p
            LEFT JOIN package_details pd ON p.id = pd.package_id
            WHERE p.id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()) {
        // Return all the data including package details and the additional fields
        echo json_encode([
            'package_type' => $row['package_type'],
            'price' => $row['price'],
            'days' => $row['days'],
            'cost_include' => $row['cost_include'] ?? '',
            'cost_exclude' => $row['cost_exclude'] ?? '',
            'overview' => $row['overview'] ?? '',
            'itinerary' => $row['itinerary'] ?? ''
        ]);
    } else {
        echo json_encode([
            'package_type' => '',
            'price' => '',
            'days' => '',
            'cost_include' => '',
            'cost_exclude' => '',
            'overview' => '',
            'itinerary' => ''
        ]);
    }
    
    $stmt->close();
}

$conn->close();
?>