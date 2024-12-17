<?php
session_start();
include('../includes/db.php');

// Cek jika pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Proses jika formulir edit dikirimkan
if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update data pengguna ke database
    $update_query = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $user_id);

    if ($stmt->execute()) {
        // Redirect ke halaman profil setelah berhasil update
        header("Location: profil.php");
        exit();
    } else {
        $error = "Gagal memperbarui profil. Coba lagi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pengguna</title>
    <link rel="stylesheet" href="">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background: white;
            color: #333;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .profile-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #16a085;
        }

        .profile-container form {
            display: flex;
            flex-direction: column;
        }

        .profile-container input,
        .profile-container textarea {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .profile-container button {
            padding: 15px;
            background-color: #16a085;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-container button:hover {
            background-color: #1abc9c;
        }

        .profile-container .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .profile-container {
                padding: 20px;
            }

            .profile-container h2 {
                font-size: 24px;
            }

            .profile-container button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Edit Profil</h2>
    
    <!-- Menampilkan pesan error jika ada -->
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="profil.php">
        <div class="form-group">
            <input type="text" name="full_name" placeholder="Nama Lengkap" value="<?php echo $user['full_name']; ?>" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" name="phone" placeholder="Nomor Telepon" value="<?php echo $user['phone']; ?>" required>
        </div>
        <div class="form-group">
            <textarea name="address" placeholder="Alamat" required><?php echo $user['address']; ?></textarea>
        </div>
        <button type="submit" name="update">Perbarui Profil</button>
    </form>
</div>

</body>
</html>
