<?php
session_start();
require_once 'connection.php';

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the product ID from the query string
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($product_id) {
    $sql = "SELECT * FROM products WHERE id = $1";
    $result = pg_query_params($conn, $sql, [$product_id]);
    $product = pg_fetch_assoc($result);
} else {
    header("Location: product.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Product Details</h1>
    <?php if ($product): ?>
        <div class="product-details">
            <p><strong>Name:</strong> <?= htmlspecialchars($product['name']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>
            <p><strong>Price:</strong> $<?= htmlspecialchars($product['price']) ?></p>
        </div>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>

    <!-- Back and Home Buttons -->
    <div class="buttons">
        <a href="product.php" class="btn">Back</a>
        <a href="home.php" class="btn">Home</a>
    </div>
</body>
</html>
