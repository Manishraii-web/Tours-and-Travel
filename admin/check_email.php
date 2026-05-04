<?php
// check_email.php
include "connection.php";

header('Content-Type: application/json');

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    // Prepare SQL statement
    $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        $response = array(
            'exists' => $row['count'] > 0,
            'message' => $row['count'] > 0 ? 'Email found! You can proceed to login.' : 'Email not found! Please sign up first.'
        );
        
        echo json_encode($response);
    } else {
        echo json_encode(array(
            'exists' => false,
            'message' => 'Error checking email'
        ));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(array(
        'exists' => false,
        'message' => 'No email provided'
    ));
}
?>