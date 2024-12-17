<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CanvasCo</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #eef2f3; /* Soft background */
        }

        /* Welcome Section */
        .welcome-section {
            height: 100vh;
            background: linear-gradient(135deg, #16a085, #2ecc71);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
            border: 4px solid white; /* Tambahkan border putih */
            border-radius: 15px; /* Membuat sudut border melengkung */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Efek bayangan untuk menonjolkan logo */
        }


        h1 {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
            line-height: 1.8;
            color: #f4f4f4;
        }

        .btn-group {
            display: flex;
            gap: 20px;
        }

        .btn {
            padding: 15px 35px;
            font-size: 18px;
            text-decoration: none;
            background-color: white;
            color: #16a085;
            border-radius: 50px;
            transition: all 0.4s ease;
            border: 2px solid white;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #2ecc71;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.1); /* Hover effect */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 36px;
            }

            p {
                font-size: 16px;
            }

            .btn {
                font-size: 16px;
                padding: 12px 25px;
            }

            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                max-width: 150px;
            }

            .btn {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Welcome Section -->
    <section class="welcome-section">
        <img src="assets/logo.png" alt="CanvasCo Logo" class="logo">
        <h1>Welcome to CanvasCo</h1>
        <p>Temukan koleksi tote bag yang tidak hanya stylish tetapi juga ramah lingkungan!</p>
        <div class="btn-group">
            <a href="auth/login.php" class="btn">Login</a>
            <a href="auth/signup.php" class="btn">Sign Up</a>
        </div>
    </section>
</body>
</html>
