<?php
// Include header and connection files
include "header.php";
include "connection.php";

// Query to fetch the top packages (initial data display)
$sql = "SELECT * FROM tourism_packages WHERE package_type = 'top' LIMIT 4";
$top_packages_result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* Package styling */
        .package-category {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .packages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 40px;
            background-color: #fff;
        }

        .image-container {
            display: flex;
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
            background: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            gap: 40px;
            width: 400px;
        }

        .image-container img {
            gap: 40px;
            height: 300px;
            object-fit: cover;

        }

        .image-container:hover {
            transform: scale(1.05);
        }

        .image-container p {
            margin: 10px 0;
            font-weight: bold;
            color: #555;
        }

        .image-container .price {
            color: #3b5998;
        }

        .image-container a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="hero">
            <h1>Dream Larger<br>Travel Smarter</h1>
            <!-- Search bar -->
            <div class="searchbar">
                <!-- Form submits to packages.php with the search query -->
                <form action="admin/package.php" method="GET" id="search-form">
                    <input type="text" name="search" id="search" placeholder="Search here"
                        value="<?php echo isset($_SESSION['search_term']) ? $_SESSION['search_term'] : ''; ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="package-category">
            <!-- <h2>🏆 Top Packages</h2> -->
            <!-- <div class="package-grid">  -->
            <!-- php 
                // if ($top_packages_result->num_rows > 0) {
                    // while ($row = $top_packages_result->fetch_assoc()) {
                        // echo '<div class="package">';
                        // echo '<a href="package_details.php?package_id=' . $row["id"] . '">'; 
                        // echo '<img src="../admin/img/' . $row["photo_url"] . '" alt="Package Image">';
                        // echo '<h3>' . $row["package_name"] . '</h3>';
                        // echo '<p>' . $row["description"] . '</p>';
                        // echo '<p><strong>Price:</strong> Rs:' . $row["price"] . '</p>';
                        // echo '<a href="../book.php?package_id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                        // echo '</div>';
                    // }
                // } else {
                    // echo "<p>No Top Packages found.</p>";
                // }
                // ?>
             </div> -->
            <div class="package-category">
                <div class="image-container">
                    <a href="admin/package.php">
                        <img src="swambu.jpg" alt="Swambunath">
                        <p>Swoyambhunath Stupa</p>
                    </a>
                </div>

                <div class="image-container">
                    <a href="admin/package.php">
                        <img src="skudive.jpg" alt="Mt. Everest">
                        <p>Bungee Jumping</p>
                    </a>

                </div>
                <div class="image-container">

                    <a href="admin/package.php">
                        <img src="janakpur.webp" alt="Janaki Temple">
                        <p>Janaki Temple</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Suggestions box -->
    <div id="suggestions"></div>

    <!-- JavaScript for AJAX Search and Enter Key handling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // When the user types in the search bar
            $('#search').keyup(function () {
                let query = $(this).val(); // Get the input value
                if (query.length > 2) { // Start searching after 3 characters
                    $.ajax({
                        url: 'search_suggestions.php', // PHP script for handling the search
                        method: 'GET',
                        data: { search: query }, // Send the search term as a query parameter
                        success: function (response) {
                            if (response.trim().length > 0) {
                                $('#suggestions').html(response).show(); // Display suggestions
                            } else {
                                $('#suggestions').hide(); // Hide if no results
                            }
                        },
                        error: function () {
                            console.log("Error in AJAX request");
                        }
                    });
                } else {
                    $('#suggestions').hide(); // Hide suggestions if input is less than 3 characters
                }
            });

            // When a user clicks a suggestion
            $(document).on('click', '.suggestion-item', function () {
                let package_id = $(this).data('id');
                window.location.href = 'package_details.php?package_id=' + package_id; // Redirect to the package details page
            });

            // When the user presses Enter in the search bar
            $('#search').keypress(function (e) {
                if (e.which == 13) {  // Check if Enter key is pressed
                    let query = $(this).val(); // Get the input value
                    if (query.length > 2) {
                        // Manually submit the form to packages.php under the admin folder
                        $('#search-form').submit(); // Submit the form to packages.php
                    }
                }
            });
        });
    </script>
</body>

</html>

<?php
// Include footer file
include "footer.php";

// Clear the search term from session after the page is loaded (if not submitting a search)
unset($_SESSION['search_term']);
?>