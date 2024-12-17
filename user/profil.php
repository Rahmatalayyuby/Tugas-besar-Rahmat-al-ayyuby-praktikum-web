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
        header("Location: profil.php");
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
    <title>User Profile</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Header */
        .main-header {
            background-color: #2c3e50;
            color: white;
            padding: 21px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .main-header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
        .main-header .logo h1 {
            font-size: 24px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            color: #1abc9c;
        }

        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            margin-top: 80px; /* Adjusted to ensure header doesn't overlap */
            width: 100%;
            max-width: 1200px;
            margin: 80px auto;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #34495e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            height: calc(100vh - 80px); /* Full height except header */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            display: block;
            text-decoration: none;
            color: #ecf0f1;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover effect for sidebar items */
        .sidebar ul li a:hover {
            background-color: #1abc9c;
            color: white;
        }

        /* Active link state */
        .sidebar ul li a.active {
            background-color: #16a085;
            color: white;
        }

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
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <h1>CanvasCo</h1>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="dashboard.php#home" >Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
             
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="profil.php" class="active">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="profil.php" class="active">Profile</a></li>
                    <li><a href="pengaturan.php" class="">Pengaturan</a></li>
                    <li><a href="../index.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Profile Section -->
        <div class="profile-container">
            <h1>User Profile</h1>

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
            <a href="edit-profil.php?edit=true" class="btn-edit">Edit Profile</a>
        </div>
    </div>
</body>
</html>
