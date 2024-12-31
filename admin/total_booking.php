<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Add some basic styling for the modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Modal Form Styling */
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        
        <div class="stats">
            <div class="stat">
                <h3>Total Users</h3>
                <p>350</p>
            </div>
            <div class="stat">
                <h3>Total Bookings</h3>
                <p>250</p>
            </div>
            <div class="stat">
                <h3>Available Tours</h3>
                <p>12</p>
            </div>
            <div class="stat">
                <h3>Total Revenue</h3>
                <p>$12,500</p>
            </div>
        </div>


        <!-- Total Bookings Section -->
        <section class="total-bookings">
            <h2>Total Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User</th>
                        <th>Tour</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>John Doe</td>
                        <td>Paris Tour</td>
                        <td>$500</td>
                        <td>2024-12-28</td>
                    </tr>
                    <tr>
                        <td>#1002</td>
                        <td>Jane Smith</td>
                        <td>London Tour</td>
                        <td>$350</td>
                        <td>2024-12-27</td>
                    </tr>
                    <tr>
                        <td>#1003</td>
                        <td>Mary Johnson</td>
                        <td>New York Tour</td>
                        <td>$600</td>
                        <td>2024-12-26</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Modal for Adding a Tour -->

        <!-- Modal for Adding a Booking -->
    </div>
</body>
</html>
