<?php
include('../includes/db.php');
$product_id = $_GET['product_id'];

$conn->query("DELETE FROM products WHERE product_id = $product_id");
header("Location: manage-products.php");

?>