<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product name from the form
    $name = $_POST['productname'];

    // Database connection
    include 'connection.php';

    // Prepare the query to insert data
    $query = "INSERT INTO products (name, description, price) VALUES ($1, $2, $3)";
    $stmt->execute([':productname' => $name]);
    echo "<p>Product added successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" action="">
        <label>Product Name:</label>
        <input type="text" name="productname" required><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
