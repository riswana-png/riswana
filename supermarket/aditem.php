<?php
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");

if (isset($_POST['submit'])) {
    $name = $_POST['itemname']; 
    $category = $_POST['category']; 
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["itemimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }

    if ($_FILES["itemimage"]["size"] > 500000) { 
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["itemimage"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO items (name, category, price, quantity, image_path) VALUES ('$name', '$category', '$price', '$quantity', '$target_file')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Item added successfully!');</script>";
            } else {
                echo "<script>alert('Error adding item: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}

// Close the database connection
mysqli_close($conn);

?>

<?php include 'nav.php'; ?>

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
    <form class="Logincontainer" action="" method="post" enctype="multipart/form-data">
    <h1>ADD ITEM</h1>
    
    <input class="Logininput1" type="text" placeholder="Name" name="itemname" required>
    <select class="Logininput1" name="category" required>
        <?php
        session_start();
        $con = mysqli_connect("localhost", "root", "", "supermarket_management_system");
        if (!$con) {
            echo "DB not Connected";
        }
        $sql = "SELECT * FROM categories";
        $data = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($data)) {
            ?>
            <option value="<?php echo $row['category_name']; ?>">
                <?php echo $row['category_name']; ?>
            </option>
        <?php } ?>
    </select>

    <input class="Logininput1" type="number" step="0.01" placeholder="Price" name="price" required>
    <input class="Logininput1" type="number" placeholder="Quantity" name="quantity" required>
    
    <!-- New input for image upload -->
    <input class="Logininput1" type="file" name="itemimage" accept="image/*" required>

    <input class="Logininput2" type="submit" value="ADD" name="submit">
</form>

    </section>
</body>
</html>
