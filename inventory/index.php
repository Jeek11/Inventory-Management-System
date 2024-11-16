<?php
include 'config.php';

// Initialize the search query
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Modify the SQL query to filter based on the search input
$sql = "SELECT * FROM products";
if ($search) {
    $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($search) . "%'";  // Search by product name
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<div class="container">
    <h1>Inventory Management System</h1>

    <!-- Search Form -->
    <form method="POST" action="search_product.php" class="search-container">
        <span class="fa fa-search"></span>
        <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>" class="search-input">
        <button type="submit">Search</button>
    </form>

    <a href="add_product.php" class="btn">Add New Product</a>
    <hr>

    <!-- Table of products -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>₱<?php echo $row['price']; ?></td>
                <td>
                    <!-- Edit icon -->
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a> 
                    | 
                    <!-- Delete icon -->
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" title="Delete">
                    <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
