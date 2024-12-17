<?php
include('../includes/db.php');

$product_id = $_GET['product_id'];
$data = $conn->query("SELECT * FROM products WHERE product_id = $product_id")->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    $conn->query("UPDATE products SET 
        name = '$name', 
        description = '$description', 
        price = '$price', 
        stock = '$stock', 
        category = '$category' 
        WHERE product_id = $product_id");

    header("Location: manage-products.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit produk</title>
    <link rel="stylesheet" href="../assets/css/add.css">
</head>
<body>
    <h1>Edit Produk</h1>
    <form method="post">
        <label>Nama Produk:</label><br>
        <input type="text" name="name" value="<?= $data['name'] ?>" required><br>
        <label>Deskripsi:</label><br>
        <input type="text" name="description" value="<?= $data['description'] ?>" required><br>
        <label>Harga Produk:</label><br>
        <input type="number" name="price" value="<?= $data['price'] ?>" required><br>
        <label>Stok Produk:</label><br>
        <input type="number" name="stock" value="<?= $data['stock'] ?>" required><br>
        <label>Kategori Produk:</label><br>
        <input type="text" name="category" value="<?= $data['category'] ?>" required><br>
        <br>
        <label for="image">Product Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>