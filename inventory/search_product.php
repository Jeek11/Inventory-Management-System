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
    <title>Search Results - Inventory Management System</title>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<div class="container">
    <h1>Search Results</h1>

    <!-- Back to Inventory link -->
    <a href="index.php" class="btn">Back to Inventory</a>
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
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['quantity']}</td>
                            <td>\${$row['price']}</td>
                            <td>
                                <a href='edit_product.php?id={$row['id']}' title='Edit'><i class='fas fa-edit'></i></a> 
                                | 
                                <a href='delete_product.php?id={$row['id']}' title='Delete'><i class='fas fa-trash-alt' style='color:red;'></i></a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No products found matching your search.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
