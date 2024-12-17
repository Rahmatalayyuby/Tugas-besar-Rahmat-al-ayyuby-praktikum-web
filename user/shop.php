<?php
session_start();
include('../includes/db.php');

if ($_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
}

$query = "SELECT name, price, image FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: #f8f8f8;
    
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
    
}

/* Header */
.main-header {
    background-color: #2c3e50;
    color: white;
    padding: 5px 0;
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

/* Hero Section */
.hero {
    background-color: #1abc9c;
    color: white;
    text-align: center;
    padding: 50px 0;
    margin-top: 50px;
}

.hero .hero-text h2 {
    font-size: 36px;
    margin-bottom: 10px;
}

.hero .hero-text p {
    font-size: 18px;
    margin-bottom: 20px;
}

.hero .btn {
    padding: 10px 20px;
    background-color: white;
    color: #1abc9c;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.hero .btn:hover {
    background-color: #16a085;
    color: white;
}

/* Featured Products */
.featured-products {
    padding: 80px 0;
   
}

.featured-products h2 {
    text-align: center;
    margin-bottom: 30px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
}

.product-card {
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
}

.product-card h3 {
    font-size: 18px;
    margin-bottom: 5px;
}

.product-card p {
    font-size: 16px;
    color: #1abc9c;
    margin-bottom: 10px;
}

.product-card .btn {
    padding: 8px 15px;
    background-color: #1abc9c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s;
}

.product-card .btn:hover {
    background-color: #16a085;
}

/* About Section */
.about {
    background-color: #f4f4f4;
    padding: 50px 0;
    text-align: center;
}

.about h2 {
    margin-bottom: 20px;
}
/* Contact Section */
.contact {
    padding: 50px 0;
    text-align: center;
    background-color: #f4f4f4;
}

.contact h2 {
    margin-bottom: 20px;
    font-size: 32px;
    color: #333;
}

.contact form {
    max-width: 600px;
    margin: 0 auto;
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.contact input, .contact textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

.contact input:focus, .contact textarea:focus {
    border-color: #1abc9c;
    outline: none;
}

.contact textarea {
    resize: vertical;
    min-height: 150px;
}

.contact .btn {
    background-color: #1abc9c;
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
}

.contact .btn:hover {
    background-color: #16a085;
}

@media (max-width: 768px) {
    .contact form {
        padding: 20px;
    }
    
    .contact h2 {
        font-size: 28px;
    }
}

@media (max-width: 480px) {
    .contact form {
        padding: 15px;
    }

    .contact h2 {
        font-size: 24px;
    }

    .contact input, .contact textarea {
        font-size: 14px;
    }

    .contact .btn {
        font-size: 14px;
        padding: 10px 15px;
    }
}
/* Footer Styles */
.main-footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: 50px;
    border-top: 5px solid #1abc9c;
    font-size: 14px;
}

.main-footer p {
    margin: 0;
}

.main-footer a {
    color: #1abc9c;
    text-decoration: none;
    transition: color 0.3s;
}

.main-footer a:hover {
    color: #16a085;
    text-decoration: underline;
}


</style>

<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <h1>CanvasCo</h1>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="shop.php" class="active">Shop</a></li>
                 
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="profil.php">Profile</a></li>
                    
                </ul>
            </nav>
        </div>
    </header>

    <!-- Featured Products -->
    <section class="featured-products" id="shop">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php
                // Loop untuk menampilkan produk
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product-card'>";
                        echo "<img src='../admin/uploads/" . basename($row['image']) . "' alt='" . $row['name'] . "'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<p>Rp " . number_format($row['price'], 0, ',', '.') . "</p>";
                        echo "<a href='http://wa.me/6282395430196' class='btn'>Pesan sekarang</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products available</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
             <p>&copy; 2024 Totebag Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>


