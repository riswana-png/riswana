<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['item_id'])) {
    $item_id = intval($_POST['item_id']);

    $sql = "SELECT * FROM items WHERE id = $item_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);

        $cart_item = [
            'id' => $item['id'],
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => 1, 
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; 
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$cart) {
            if ($cart['id'] == $item['id']) {
                $cart['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $cart_item; 
        }

        echo "<script>alert('Item added to cart successfully!');</script>";
    } else {
        echo "<script>alert('Item not found.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}

header("Location: buy_products.php");
exit;

mysqli_close($conn);
?>
