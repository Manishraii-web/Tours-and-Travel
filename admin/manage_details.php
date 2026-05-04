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
    $cost_include = isset($_POST['cost_include']) ? trim($_POST['cost_include']) : '';
    $cost_exclude = isset($_POST['cost_exclude']) ? trim($_POST['cost_exclude']) : '';
    $overview = isset($_POST['overview']) ? trim($_POST['overview']) : '';
    $itinerary = isset($_POST['itinerary']) ? trim($_POST['itinerary']) : '';
    
    // Get the additional fields
    $package_type = $_POST['package_type'];
    $price = floatval($_POST['price']);
    $days = intval($_POST['days']);
    
    // First, update the main package information
    $update_package_sql = "UPDATE tourism_packages 
                          SET package_type = ?, price = ?, days = ? 
                          WHERE id = ?";
    
    $update_stmt = $conn->prepare($update_package_sql);
    $update_stmt->bind_param("sdii", $package_type, $price, $days, $package_id);
    $update_stmt->execute();
    $update_stmt->close();
    
    // Check if details already exist for this package
    $check_sql = "SELECT package_id FROM package_details WHERE package_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $package_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if($check_result->num_rows > 0) {
        // Update existing details
        $sql = "UPDATE package_details 
                SET cost_include = ?, cost_exclude = ?, overview = ?, itinerary = ? 
                WHERE package_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $cost_include, $cost_exclude, $overview, $itinerary, $package_id);
    } else {
        // Insert new details - only if at least one field has content
        if(!empty($cost_include) || !empty($cost_exclude) || !empty($overview) || !empty($itinerary)) {
            $sql = "INSERT INTO package_details (package_id, cost_include, cost_exclude, overview, itinerary) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $package_id, $cost_include, $cost_exclude, $overview, $itinerary);
            
            if($stmt->execute()) {
                echo "Details saved successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            // No details provided, but package info was updated
            echo "Package information updated successfully!";
        }
        
        $check_stmt->close();
        $conn->close();
        exit;
    }
    
    if($stmt->execute()) {
        echo "Details saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $check_stmt->close();
}

$conn->close();
?>