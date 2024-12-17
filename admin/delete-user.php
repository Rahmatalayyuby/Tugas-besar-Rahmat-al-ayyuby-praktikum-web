<?php
include('../includes/db.php');
$user_id = $_GET['user_id'];

$conn->query("DELETE FROM users WHERE user_id = $user_id");
header("Location: manage-users.php");

?>