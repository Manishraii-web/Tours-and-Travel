
<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "tourism";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch total users count
$total_users = 0;
$result = $conn->query("SELECT COUNT(*) as total FROM users");
if ($result) {
    $row = $result->fetch_assoc();
    $total_users = $row['total'];
}

// Delete User
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Update User
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $firstname, $lastname, $email, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating user: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: coral
        }
        button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #b02a37;
        }
        .form-container {
            display: none;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard - Manage Users</h1>
    
    <!-- Display Total Users -->
    <p><strong>Total Users: <?= $total_users ?></strong></p>

    <!-- Users Table -->
    <table>
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM users");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    // Change this in your manage_user.php file
echo "<td>
<a href='edit_user.php?id=" . $row['id'] . "'>
    <button>Edit</button>
</a>
<a href='manage_user.php?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this user?')\">
    <button class='delete-btn'>Delete</button>
                            </a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Edit User Form -->
    <div id="editForm" class="form-container">
        <h3>Edit User</h3>
        <form method="POST">
            <input type="hidden" name="user_id" id="user_id">
            <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" id="firstname" required><br>
            <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" id="lastname" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>
            <button type="submit" name="update_user">Update User</button>
        </form>
    </div>

    <script>
        function showEditForm(id, firstname, lastname, email) {
            document.getElementById('user_id').value = id;
            document.getElementById('firstname').value = firstname;
            document.getElementById('lastname').value = lastname;
            document.getElementById('email').value = email;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>

</body>
</html>

<?php
mysqli_close($conn);
?>