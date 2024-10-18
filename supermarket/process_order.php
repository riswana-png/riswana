<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $total = $_POST['total'];
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    $item_ids = [];
    foreach ($_SESSION['cart'] as $item) {
        $item_ids[] = $item['id'];
    }
    $item_ids_string = implode(',', $item_ids);
    
    // Insert the order into the orders table
    $sql = "INSERT INTO orders (user_id, item_ids, delivery_address, total_amount, payment_method) VALUES ('$user_id', '$item_ids_string', '$address', '$total', '$payment_method')";
    
    if (mysqli_query($conn, $sql)) {
        // Loop through cart to update item quantities
        foreach ($_SESSION['cart'] as $item) {
            $item_id = $item['id'];
            $quantity_purchased = $item['quantity']; // Assuming you have quantity in cart

            $update_sql = "UPDATE items SET quantity = quantity - $quantity_purchased WHERE id = $item_id";
            mysqli_query($conn, $update_sql);
        }

        echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'Userdash.html';
              </script>";
        unset($_SESSION['cart']);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
