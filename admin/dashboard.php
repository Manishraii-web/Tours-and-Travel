<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <div class="stats">
            <div class="stat">
                <h3>Total Users</h3>
                <p id="totalUsers">Loading...</p>
            </div>
            <div class="stat">
                <h3>Total Bookings</h3>
                <p id="totalBookings">Loading...</p>
            </div>
            <div class="stat">
                <h3>Available Tours</h3>
                <p id="availableTours">Loading...</p>
            </div>
            <div class="stat">
                <h3>Total Revenue</h3>
                <p id="totalRevenue">Loading...</p>
            </div>
        </div>

        <section class="recent-bookings">
            <h2>Recent Bookings</h2>
            <table id="bookingsTable">
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
                    </tbody>
            </table>
        </section>

        <div class="charts">
            <canvas id="bookingsChart"></canvas>
        </div>

    </div>

    <script src="dashboard.js"></script> 
</body>
</html>