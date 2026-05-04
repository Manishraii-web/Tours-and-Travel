<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['phone'] = $_POST['phone'] ?? $_SESSION['phone'] ?? '';

    $amount = $_SESSION['amount'] ?? '';
    $package = $_SESSION['package'] ?? '';
    $name = $_SESSION['name'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $phone = $_SESSION['phone'] ?? '';

    if (empty($amount) || empty($package) || empty($name) || empty($email) || empty($phone)) {
        echo "<p style='color:red;'>Error: Missing required fields.</p>";
        header("Refresh: 3; URL=checkout.php");
        exit();
    }

    // ✅ Correct API URL for Website Payments
    $khalti_api_url = "https://khalti.com/api/v2/epayment/initiate/";
    $khalti_secret_key = "live_secret_key_xxxxxx"; // Replace with your actual Secret Key

    // ✅ Payment Request Data
    $postFields = [
        "return_url" => "http://localhost/project-i/khalti/success.php",
        "website_url" => "http://localhost/project-i/",
        "amount" => $amount * 100, // Convert Rs to Paisa
        "purchase_order_id" => uniqid(),
        "purchase_order_name" => $package,
        "product_identity" => "trip_package_" . $package,
        "product_name" => [$package],
        "customer_info" => [
            "name" => $name,
            "email" => $email,
            "phone" => $phone
        ]
    ];

    // ✅ Convert Data to JSON
    $postData = json_encode($postFields);

    // ✅ Debugging: Print API Request Data (for development only)
    echo "<pre>";
    echo "Using Secret Key: " . substr($khalti_secret_key, 0, 10) . "********<br>";
    print_r($postData);
    echo "</pre>";

    // ✅ Initialize cURL Request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $khalti_api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Key $khalti_secret_key",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // ✅ Execute API Call
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    // ✅ Handle cURL Errors
    if ($curl_error) {
        echo "<p style='color:red;'>cURL Error: $curl_error</p>";
        exit();
    }

    // ✅ Handle Khalti API Response
    if ($http_code == 200) {
        $response_data = json_decode($response, true);
        if (isset($response_data["payment_url"])) {
            header("Location: " . $response_data["payment_url"]);
            exit();
        } else {
            echo "<p style='color:red;'>Error: Invalid response from Khalti.</p>";
            exit();
        }
    } else {
        echo "<p style='color:red;'>Unexpected response from Khalti: $response</p>";
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
