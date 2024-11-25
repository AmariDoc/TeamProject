<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to the Product Management System</h1>
    <div class="buttons">
        <a href="product.php" class="btn">View Products</a>
        <a href="addproduct.php" class="btn">Add Product</a>
    </div>
</body>
</html>
