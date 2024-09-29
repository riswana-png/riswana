<!DOCTYPE html>
<html>
<head>
    <title>MANAGE ITEM</title>
    <link rel="stylesheet" href="manageuser.css">
</head>
<body>
    <nav class="ViewCandidatesNav"> 
        <h1 class="ViewCandidatesNavHeading">MANAGE ITEM</h1>
        <div class="ViewCandidatesNavContainer">
            <a href="Admindash.php">Home</a>
        </div>
    </nav>

    <?php
    // Initialize itemDetails
    $itemDetails = null;

    // Check if 'itemedit' is set in the POST request
    if (isset($_POST['itemedit'])) {
        $id = $_POST['itemedit'];
        $conn = new mysqli("localhost", "root", "", "supermarket_management_system");

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM `items` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data1 = $stmt->get_result();

        if ($data1) {
            $itemDetails = $data1->fetch_assoc();

            if ($itemDetails) {
                if (isset($_POST['itemediting'])) {
                    $itemId = $_POST['id'];
                    $name = $_POST['name'];
                    $category = $_POST['category'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    // Update item details
                    $profileUpdateSql = "UPDATE `items` SET `name`=?, `category`=?, `price`=?, `quantity`=? WHERE `id`=?";
                    $updateStmt = $conn->prepare($profileUpdateSql);
                    $updateStmt->bind_param("ssddi", $name, $category, $price, $quantity, $itemId);
                    
                    if ($updateStmt->execute()) {
                        echo "<script>alert('Update successful'); window.location.href='manageitem.php';</script>";
                        exit();
                    } else {
                        echo "<script>alert('Update Failed: " . $conn->error . "');</script>";
                    }
                }
            } else {
                echo "<script>alert('Item not found');</script>";
            }
        } else {
            echo "<script>alert('Query execution failed');</script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="post">
        <input required class="inp" type="hidden" name="itemedit" value="<?php echo isset($itemDetails['id']) ? htmlspecialchars($itemDetails['id']) : ''; ?>">
        <table>
            <tr>
                <td>Item Name:</td>
                <td><input required class="inp" type="text" name="name" value="<?php echo isset($itemDetails['name']) ? htmlspecialchars($itemDetails['name']) : ''; ?>" placeholder="Item name"></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td><input required class="inp" type="text" name="category" value="<?php echo isset($itemDetails['category']) ? htmlspecialchars($itemDetails['category']) : ''; ?>"></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input required class="inp" type="number" step="0.01" name="price" value="<?php echo isset($itemDetails['price']) ? htmlspecialchars($itemDetails['price']) : ''; ?>"></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><input required class="inp" type="number" name="quantity" value="<?php echo isset($itemDetails['quantity']) ? htmlspecialchars($itemDetails['quantity']) : ''; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button id="hero_bt" type="submit" name="itemediting">Update</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
