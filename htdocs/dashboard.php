<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="mainpage.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="admin-dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="Primary_Logo-removebg-preview.png" alt="Cafe Logo">
            </div>
            <div class="admin-info">
                <img src="download-removebg-preview.png" alt="Admin">
                <h3>Admin</h3>
                <a href="editprofile.html">Edit Profile</a>
            </div>
            <nav>
                <ul>
                    <li><a href="mainpage.html">Dashboard</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="order.html">Orders</a></li>
                    <li><a href="customer.html">Customers Reviews</a></li>
                    <li><a href="usermngt.php">User Management</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="login.php">⬅ Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="content">
            

            <h2 class="chart-title">Daily Coffee Sales</h2>
            <div class="chart-container">
                <canvas id="coffeeSalesChart"></canvas>
            </div>
        </main>
    </div>

    <script src="mainpage.js"></script>
</body>
</html>
