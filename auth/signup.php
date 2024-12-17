<?php
include('../includes/db.php');

if (isset($_POST['signup'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "INSERT INTO users (full_name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $full_name, $email, $password, $phone, $address);
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        $error = "Gagal mendaftar, coba lagi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - CanvasCo</title>
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

        .signup-container {
            background: white;
            color: #333;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #16a085;
        }

        .signup-container form {
            display: flex;
            flex-direction: column;
        }

        .signup-container input,
        .signup-container textarea {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .signup-container button {
            padding: 15px;
            background-color: #16a085;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-container button:hover {
            background-color: #1abc9c;
        }

        .signup-container .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .signup-container {
                padding: 20px;
            }

            .signup-container h2 {
                font-size: 24px;
            }

            .signup-container button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Daftar</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="full_name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Nomor Telepon" required>
            <textarea name="address" placeholder="Alamat" required></textarea>
            <button type="submit" name="signup">Daftar</button>
        </form>
    </div>
</body>
</html>
