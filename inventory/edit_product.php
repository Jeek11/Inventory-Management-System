
<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get product data to prefill the form
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Update product in the database
    $sql = "UPDATE products SET name = '$name', description = '$description', quantity = '$quantity', price = '$price' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
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
    <title>Edit Product</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="styles2.css">
</head>
<body>

<div class="container">
    <h1>Edit Product</h1>

    <form action="edit_product.php?id=<?php echo $product['id']; ?>" method="POST">
        <div class="form-group">
            <label for="name">Product Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br>
        </div>

        <div class="form-group">
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" required><?php echo $product['description']; ?></textarea><br>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label><br>
            <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>
        </div>

        <div class="form-group">
            <label for="price">Price:</label><br>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo $product['price']; ?>" required><br>
        </div>

        <button type="submit">Update Product</button>
    </form>

    <!-- Back to Inventory Button -->
    <a href="index.php" class="back-btn">Back to Inventory</a>
</div>

</body>
</html>  

<?php $conn->close(); ?>