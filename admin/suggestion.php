<?php


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourism";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from the database for admin view
$sql = "SELECT id, name, email, message, created_at FROM ContactMessages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .message-container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            
        }
        .message-card {
            background-color:coral;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .message-card .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .message-card .header h3 {
            margin: 0;
            font-size: 18px;
            color: #3b5998;
        }
        .message-card .header span {
            font-size: 14px;
            color: #777;
        }
        .message-card p {
            color: #555;
            line-height: 1.5;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Admin - Contact Messages</h1>
    <div class="message-container">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="message-card">';
                echo '  <div class="header">';
                echo '    <h3>' . htmlspecialchars($row["name"]) . ' (' . htmlspecialchars($row["email"]) . ')</h3>';
                echo '    <span>' . htmlspecialchars($row["created_at"]) . '</span>';
                echo '  </div>';
                echo '  <p>' . nl2br(htmlspecialchars($row["message"])) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p style="text-align:center;">No messages found.</p>';
        }
        $conn->close();
        ?>
    </div>


</body>
</html>
