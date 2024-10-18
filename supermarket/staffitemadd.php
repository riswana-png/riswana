<?php
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");

if (isset($_POST['submit'])) {
    $name = $_POST['itemname']; 
    $category = $_POST['category']; 
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (!empty($name) && !empty($category) && is_numeric($price) && is_numeric($quantity)) {
        // Prepare and execute the insert query
        $sql = "INSERT INTO items (name, category, price, quantity) VALUES ('$name', '$category', '$price', '$quantity')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Item added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding item: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields correctly.');</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php include 'navs.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admindash.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="addstaff.css">
    <title>Add Item</title>
</head>
<body>
    <section class="Main">
        <form class="Logincontainer" action="" method="post">
            <h1>ADD ITEM</h1>
            
            <input class="Logininput1" type="text" placeholder="Name" name="itemname" required>
            <select class="Logininput1" name="category" id="" placeholder="Category" required >
	                <?php
                    session_start();
                    $con = mysqli_connect("localhost", "root", "", "supermarket_management_system");
                    if (!$con) {
                        echo "DB not Connected";
                    }
	                        $sql="SELECT * FROM categories";
	                       $data=mysqli_query($con,$sql);
	                       while($row=mysqli_fetch_array($data)){
	                       ?>
	                       <option
	                        value="<?php echo $row['category_name'];?>">
	                        <?php echo $row['category_name']; ?> 
	                      </option>
	                    <?php } ?>
  
                <input class="Logininput1" type="number" step="0.01" placeholder="Price" name="price" required>
            <input class="Logininput1" type="number" placeholder="Quantity" name="quantity" required>

            <input class="Logininput2" type="submit" value="ADD" name="submit">
        </form>
    </section>
</body>
</html>
