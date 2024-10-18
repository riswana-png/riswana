<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewcart.css">
    <title>Your Cart</title>
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
        <h1>Your Cart</h1>
        <div class="container">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                echo '<table border="1">';
                echo '<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th><th>Actions</th></tr>';
                $total = 0;

                foreach ($_SESSION['cart'] as $item) {
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                    echo '<td>Rs.' . htmlspecialchars($item['price']) . '</td>';
                    echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                    echo '<td>Rs.' . $item_total . '</td>';
                    echo '<td>
                            <form method="POST" action="remove_from_cart.php" style="display:inline;">
                                <input type="hidden" name="item_id" value="' . $item['id'] . '">
                                <button type="submit">Remove</button>
                            </form>
                          </td>';
                    echo '</tr>';
                }
                echo '<tr><td colspan="3">Total</td><td>Rs.' . $total . '</td><td></td></tr>';
                echo '</table>';
                echo '<a href="checkout.php?total=' . $total . '" class="btn">Buy Now</a>'; // Buy Now button
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
    </section>
</body>
</html>
