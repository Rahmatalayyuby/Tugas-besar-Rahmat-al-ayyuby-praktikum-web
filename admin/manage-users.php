<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Query untuk mendapatkan semua data pengguna
$query = "SELECT * FROM users";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
      .user-management{    
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

</style>
      <body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
            <ul>
                    <li><a href="dashboard.php" >Dashboard</a></li>
                    <li><a href="manage-products.php">Manage Produk</a></li>
                    <li><a href="manage-users.php"  class="active">Manage User</a></li>
                    <li><a href="profile-admin.php" >Profile</a></li>
                    <li><a href="../index.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Manage Users!</h1>
                
            </header>

            <section class="user-management">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tgl Regist</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td>{$row['full_name']}</td>
                                        <td>{$row['email']}</td>
                                       
                                        <td>{$row['created_at']}</td>
                                        <td>{$row['role']}</td>
                                        <td>
                                            <a href='edit-user.php?user_id={$row['user_id']}' class='btn-edit'>Edit</a>
                                            <a href='delete-user.php?user_id={$row['user_id']}' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Hapus</a>
                                        </td>
                                    </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>