<?php
// Include connection file
include 'connection.php';

// Fetch products
$sql = "SELECT * FROM products";
$result = pg_query($conn, $sql);

if (!$result) {
    echo "Error fetching products: " . pg_last_error();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Product List</h1>

    <!-- Navigation Buttons -->
    <div class="buttons">
        <a href="home.php" class="btn">Home</a>
        <a href="addproduct.php" class="btn">Add Product</a>
    </div>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
