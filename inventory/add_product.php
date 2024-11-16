<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (name, description, quantity, price)
            VALUES ('$name', '$description', '$quantity', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully.";
        header("Location: index.php");  // Redirect to the inventory list
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>

    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles2.css">
</head>
<body>

<div class="container">
    <h1>Add New Product</h1>

    <form action="add_product.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required>

        <button type="submit">Add Product</button>
    </form>

   <!-- Back to Inventory Button -->
   <a href="index.php" class="back-btn">Back to Inventory</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
