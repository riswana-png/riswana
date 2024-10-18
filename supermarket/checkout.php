<?php
session_start();

$total = isset($_GET['total']) ? $_GET['total'] : 0;

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Checkout</title>
</head>
<body>
    <nav class="navbar">
        <h1>Super Market Management System</h1>
    </nav>
    
    <section class="checkout-section">
        <h1>Checkout</h1>
        <form method="POST" action="process_order.php">
            <div>
                <label for="address">Delivery Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <div>
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="cod">Cash on Delivery</option>
                    <option value="online">Online Payment</option>
                </select>
            </div>
            <div id="card-details" style="display: none;">
                <h3>Card Details</h3>
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" >
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" >
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" >
            </div>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit">Place Order</button>
        </form>
    </section>

    <script>
        const paymentMethodSelect = document.getElementById('payment_method');
        const cardDetailsDiv = document.getElementById('card-details');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'online') {
                cardDetailsDiv.style.display = 'block';
            } else {
                cardDetailsDiv.style.display = 'none';
            }
        });
    </script>
</body>
</html>
