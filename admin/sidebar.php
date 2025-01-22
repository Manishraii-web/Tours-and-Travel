<div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
        <!-- Sidebar Links with PHP embedded, passing page parameters -->
        <li><a href="?page=add_package">Manage Packages</a></li>
        <li><a href="?page=manage_users">Manage Users</a></li>
        <li><a href="?page=manage_booking">View Bookings</a></li>
        <li><a href="?page=manage_hotel">Manage Hotels</a></li>
        <li><a href="?page=report">Reports</a></li>
    </ul>
    <!-- Logout Button -->
        <button type="submit" name="logout" class="btn">Logout</button>
</div>
<style> * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Styling */
body {
    display: flex;
    flex-direction: row;
    background-color: #f4f4f4;
    height: 100vh;
}

/* Sidebar Styling for Desktop */
.sidebar {
    width: 250px;
    background-color:rgba(247, 111, 47, 0.5);
    color: #ecf0f1;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    color: #ecf0f1;
    text-decoration: none;
    padding: 10px;
    border-radius: 5px;
    display: block;
}

.sidebar ul li a:hover {
    background-color: #34495e;
}

.sidebar .btn {
    padding: 10px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.sidebar button{
    padding: 100px;
}

.sidebar .btn:hover {
    background-color: #c0392b;
}

/* Content Styling */
.content {
    margin-left: 250px; /* Space for the sidebar */
    padding: 20px;
    flex-grow: 1;
    overflow-y: auto;
}

.content h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2A2A2A;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.card {
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
    padding: 20px;
}

.card h3 {
    margin-bottom: 10px;
    color: darkblue;
}

.card p {
    margin-bottom: 15px;
    color: #7f8c8d;
}

.card .btn {
    padding: 10px 20px;
    background-color:#34549b;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.card .btn:hover {
    background-color: #4f4f4f;
}

/* Mobile View */
@media (max-width: 768px) {
    body {
        flex-direction: column;
    }

    .sidebar {
        position: static;
        width: 100%;
        height: auto;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        padding: 10px;
        gap: 10px;
    }

    .sidebar ul {
        display: flex;
        gap: 10px;
        font-size: 10px;
    }

    .sidebar ul li {
        margin-bottom: 0;
    }

    .content {
        margin-left: 0;
        padding: 10px;
    }

    .card {
        width: 100%;
    }
    .btn {
        font-size: 10px;
       
    }
}
</style>