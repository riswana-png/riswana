<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch bookings along with user names and item names
$sql = "SELECT o.id AS booking_id, 
               u.name AS user_name, 
               o.item_ids, 
               o.delivery_address, 
               o.total_amount, 
               o.payment_method 
        FROM orders o 
        JOIN users u ON o.user_id = u.userid"; // Adjust table names as necessary

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewbook.css"> <!-- Custom CSS -->
    <title>View Bookings</title>
</head>
<body>
<nav class="navbar">
    <h1>Super Market Management System</h1>
    <div class="Nav_menus">
        <a href="staffdash.php"><div class="menus">Home</div></a>
        <a href="viewbooking.php"><div class="menus">View Bookings</div></a>
        <a href="Logout.php"><div class="menus">Logout</div></a>
    </div>
</nav>

<section class="Home_Section">
    <h1>All Bookings</h1>
    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table border="1">';
            echo '<tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Item IDs</th>
                    <th>Delivery Address</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                  </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                // Fetch item names based on item_ids
                $item_ids = explode(',', $row['item_ids']);
                $item_names = [];

                foreach ($item_ids as $item_id) {
                    $item_id = intval($item_id); // Ensure item ID is an integer
                    $item_sql = "SELECT name FROM items WHERE id = $item_id";
                    $item_result = mysqli_query($conn, $item_sql);
                    if ($item_row = mysqli_fetch_assoc($item_result)) {
                        $item_names[] = $item_row['name'];
                    }
                }

                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['booking_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['user_name']) . '</td>';
                echo '<td>' . htmlspecialchars(implode(', ', $item_names)) . '</td>'; // Join item names
                echo '<td>' . htmlspecialchars($row['delivery_address']) . '</td>';
                echo '<td>Rs.' . htmlspecialchars($row['total_amount']) . '</td>';
                echo '<td>' . htmlspecialchars($row['payment_method']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No bookings found.</p>';
        }
        ?>
    </div>
</section>
</body>
</html>

<?php
mysqli_close($conn);
?>
