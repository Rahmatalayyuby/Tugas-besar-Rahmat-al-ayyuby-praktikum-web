<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}

// Query to count the total products
$queryProducts = "SELECT COUNT(*) AS total_products FROM products";
$resultProducts = $conn->query($queryProducts);
$totalProducts = $resultProducts->fetch_assoc()['total_products'];

// Query to count the total users
$queryUsers = "SELECT COUNT(*) AS total_users FROM users";
$resultUsers = $conn->query($queryUsers);
$totalUsers = $resultUsers->fetch_assoc()['total_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Sidebar */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            width: 250px;
            padding: 20px;
        }

        .sidebar .logo h1 {
            font-size: 24px;
            color: white;
            
            margin-bottom: 20px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin: 10px 0;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: white;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar nav ul li a:hover,
        .sidebar nav ul li a.active {
            background-color: #1abc9c;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        .main-header {
           
            color: black;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: white;
        }

        .card p {
            font-size: 32px;
            color: #1abc9c;
            font-weight: bold;
        }

        /* Chart Container */
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .chart-container h2 {
            text-align: center;
            margin-bottom: 20px;
         
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h1>Admin Panel</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="manage-products.php">Manage Produk</a></li>
                    <li><a href="manage-users.php">Manage User</a></li>
                    <li><a href="profile-admin.php">Profile</a></li>
                    <li><a href="../index.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Welcome, Admin!</h1>
            </header>

            <!-- Dashboard Cards -->
            <section class="dashboard-cards">
                <div class="card">
                    <h3>Total Products</h3>
                    <p><?php echo $totalProducts; ?></p>
                </div>
                <div class="card">
                    <h3>Total Users</h3>
                    <p><?php echo $totalUsers; ?></p>
                </div>
            </section>

            <!-- Chart Section -->
            <div class="chart-container">
                <h2>Data Overview</h2>
                <canvas id="dashboardChart" width="400" height="200"></canvas>
            </div>
        </main>
    </div>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Produk', 'Total Pengguna'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [<?php echo $totalProducts; ?>, <?php echo $totalUsers; ?>],
                    backgroundColor: ['#1abc9c', '#2c3e50'],
                    borderColor: ['#16a085', '#2c3e50'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
