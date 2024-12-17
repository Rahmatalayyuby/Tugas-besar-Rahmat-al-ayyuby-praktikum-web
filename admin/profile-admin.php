<?php
session_start();
include('../includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle the profile update request
if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update the user data in the database
    $update_query = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $user_id);

    if ($stmt->execute()) {
        // Redirect to the profile page after successful update
        header("Location: profile-admin.php");
        exit();
    } else {
        $error = "Failed to update the profile. Please try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
    
        /* Profile Section Styles */
        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            width: 75%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info {
            text-align: left;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 8px 0;
            color: #333;
        }

        .profile-info strong {
            color: #1abc9c;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }

        .btn-edit {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1abc9c;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-edit:hover {
            background-color: #16a085;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
                align-items: center;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
                height: auto;
            }

            .profile-container {
                width: 100%;
                padding: 20px;
            }
        }
        

</style>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h1>Admin Panel</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php" >Dashboard</a></li>
                    <li><a href="manage-products.php">Manage Produk</a></li>
                    <li><a href="manage-users.php">Manage User</a></li>
                    <li><a href="profile-admin.php" class="active">Profile</a></li>
                    <li><a href="../index.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Profile Admin!</h1>
            </header>


             <!-- Profile Section -->
        <div class="profile-container">
           

            <!-- Display error message if any -->
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <!-- Display User Profile Data -->
            <div class="profile-info">
                
                <p><strong>Nama:</strong> <?php echo $user['full_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                <p><strong>nomor Telpon:</strong> <?php echo $user['phone']; ?></p>
                <p><strong>Alamat:</strong> <?php echo nl2br($user['address']); ?></p>
            </div>

            <!-- Edit Profile Button -->
            <a href="profile-edit.php?edit=true" class="btn-edit">Edit Profile</a>
        </div>
    </div>
           
        </main>
    </div>
</body>
</html>

