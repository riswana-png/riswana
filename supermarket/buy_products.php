<?php
// Start the session
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch products from the database
$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="buyproduct.css"> <!-- Custom CSS -->
    <title>Buy Products</title>
</head>
<body>
<nav class="navbar">
    <h1>Super Market Management System</h1>
    <div class="Nav_menus">
        <a href="index.html"><div class="menus">Home</div></a>
        <a href="buy_products.php"><div class="menus">Buy</div></a>
        <a href="view_cart.php"><div class="menus">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</div></a>
        <a href="Register.php"><div class="menus">Logout</div></a>
    </div>
</nav>
    
<section class="Home_Section">
    <h1>Available Products</h1>
    <div class="container">
        <div class="product-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product-card">';
                    echo '    <img src="' . htmlspecialchars($row['image_path']) . '" class="product-image" alt="Product Image">';
                    echo '    <div class="product-details">';
                    echo '        <h5 class="product-title">' . htmlspecialchars($row['name']) . '</h5>';
                    echo '        <p class="product-price">Price: Rs.' . htmlspecialchars($row['price']) . '</p>';

                    // Check quantity and display appropriate message
                    if ($row['quantity'] > 0) {
                        echo '        <p class="product-quantity">Quantity: ' . htmlspecialchars($row['quantity']) . '</p>';
                        echo '        <form method="POST" action="add_to_cart.php">';
                        echo '            <input type="hidden" name="item_id" value="' . $row['id'] . '">';
                        echo '            <button type="submit" class="btn">Add to Cart</button>';
                        echo '        </form>';
                    } else {
                        echo '        <p class="product-quantity out-of-stock">Out of Stock</p>';
                    }

                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>
    </div>
</section>
</body>
</html>

<?php
mysqli_close($conn);
?>
