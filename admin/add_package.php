<?php
$host = 'localhost'; 
$db = 'tourism'; 
$user = 'root'; 
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding new packages
if (isset($_POST['submit'])) {
    $package_name = trim($_POST['package_name']);
    $description = trim($_POST['description']);
    $package_type = $_POST['package_type'];
    $price = floatval($_POST['price']);
    $days = intval($_POST['days']);

    if (empty($package_name) || empty($description) || empty($package_type) || empty($price) || empty($days)) {
        die("All fields are required.");
    }

    // Handle file upload
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        die("File upload failed.");
    }

    $photo = $_FILES['photo']['name'];
    $target_dir = "img/";

    if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
        die("Failed to create upload directory.");
    }

    $target_file = $target_dir . basename($photo);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!getimagesize($_FILES['photo']['tmp_name']) || $_FILES['photo']['size'] > 5000000 || !in_array($file_extension, $allowed_extensions)) {
        die("Invalid image file.");
    }

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        die("Error moving uploaded file.");
    }

    $sql = "INSERT INTO tourism_packages (package_name, description, package_type, price, days, photo_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdss", $package_name, $description, $package_type, $price, $days, $target_file);

    if ($stmt->execute()) {
        echo "<script>alert('Package added successfully!'); window.location.href='add_package.php';</script>";
    } else {
        die("Error inserting data: " . $stmt->error);
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Packages</title>
    <link rel="stylesheet" href="add_package.css">
    <link rel="stylesheet" href="manage_details..css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Modal */
    /* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-content {
    background-color: white;
    padding: 20px;
    width: 50%;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    max-height: 80vh; /* Limits modal height */
    overflow-y: auto; /* Enables vertical scrolling */
}
.close {
    float: right;
    font-size: 24px;
    cursor: pointer;
}

    </style>
</head>
<body>

    <h1>Add Tourism Package</h1>
    <form action="add_package.php" method="POST" enctype="multipart/form-data">
        <label>Package Name:</label>
        <input type="text" name="package_name" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Package Type:</label>
        <select name="package_type" required>
            <option value="top">Top Package</option>
            <option value="other">Other Package</option>
        </select><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Number of Days:</label>
        <input type="number" name="days" required><br>

        <label>Photo:</label>
        <input type="file" name="photo" accept="image/*" required><br>

        <button type="submit" name="submit">Add Package</button>
    </form>

    <h2>Existing Packages</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Price</th>
                <th>Days</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM tourism_packages ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . htmlspecialchars($row['package_name']) . '</td>
                    <td>' . htmlspecialchars($row['description']) . '</td>
                    <td>' . htmlspecialchars($row['package_type']) . '</td>
                    <td>Rs.' . number_format($row['price'], 2) . '</td>
                    <td>' . htmlspecialchars($row['days']) . ' Days</td>
                    <td><img src="' . htmlspecialchars($row['photo_url']) . '" width="100"></td>
                    <td>
                      <td>
    <button class="manage-btn" data-id="' . $row['id'] . '">Manage Details</button>
    <button class="delete-btn" data-id="' . $row['id'] . '">Delete</button>
</td>

                    </td>
                  </tr>';
        }
        ?>
        <script>$(document).on("click", ".delete-btn", function () {
    var packageId = $(this).data("id");

    if (confirm("Are you sure you want to delete this package?")) {
        $.ajax({
            url: "delete_packages.php",
            type: "POST",
            data: { package_id: packageId },
            success: function (response) {
                alert(response);
                location.reload(); // Refresh the page to update the package list
            },
            error: function () {
                alert("Error deleting package.");
            }
        });
    }
});
</script>
        </tbody>
    </table>

    <!-- Manage Details Modal -->
     <!-- Manage Details Modal -->
<div id="manageDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Manage Package Details</h2>
        <form id="manageDetailsForm">
            <input type="hidden" id="package_id" name="package_id">

            <!-- Add new fields for days, price, and package type -->
            <label>Package Type:</label>
            <select name="package_type" id="package_type" required>
                <option value="top">Top Package</option>
                <option value="other">Other Package</option>
            </select><br>

            <label>Price:</label>
            <input type="number" name="price" id="price" step="0.01" required><br>

            <label>Number of Days:</label>
            <input type="number" name="days" id="days" required><br>

            <label>Cost Includes:</label>
            <textarea name="cost_include" id="cost_include"></textarea>

            <label>Cost Excludes:</label>
            <textarea name="cost_exclude" id="cost_exclude"></textarea>

            <label>Overview:</label>
            <textarea name="overview" id="overview"></textarea>

            <label>Itinerary:</label>
            <textarea name="itinerary" id="itinerary"></textarea>

            <button type="submit">Save Details</button>
        </form>
    </div>
</div>



<script>
    $(document).on("click", ".manage-btn", function (e) {
        e.preventDefault();
        var packageId = $(this).data("id");
        $("#package_id").val(packageId);
        
        $.ajax({
            url: "fetch_package_details.php",
            type: "POST",
            data: { package_id: packageId },
            success: function (response) {
                var data = JSON.parse(response);
                
                // Populate the new fields
                $("#package_type").val(data.package_type);
                $("#price").val(data.price);
                $("#days").val(data.days);
                
                // Existing fields
                $("#cost_include").val(data.cost_include);
                $("#cost_exclude").val(data.cost_exclude);
                $("#overview").val(data.overview);
                $("#itinerary").val(data.itinerary);
            },
            error: function() {
                alert("Error fetching package details.");
            }
        });

        $("#manageDetailsModal").fadeIn();
    });

    $(".close").click(function () {
        $("#manageDetailsModal").fadeOut();
    });

    $("#manageDetailsForm").submit(function (e) {
        e.preventDefault();
        $.post("manage_details.php", $(this).serialize(), function (response) {
            alert(response);
            $("#manageDetailsModal").fadeOut();
            // Reload the page to update the displayed information
            location.reload();
        });
    });
</script>

</body>
</html>
