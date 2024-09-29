<?php
include 'nav.php';
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = $_POST['category_name'];

    if (!empty($categoryName)) {
        
        $sql ="INSERT INTO `categories`( `category_name`) VALUES ('$categoryName')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Category added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding category: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in the category name.');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addstaff.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="addcategory.css">
    <title>Add Category</title>
</head>
<body>
    <section class="Main">
        <form class="Logincontainer" action="" method="post">
            <h1>ADD CATEGORY</h1>
            <!-- <input class="Logininput1" type="number" placeholder="Category id" name="category_id" required> -->
            <input class="Logininput1" type="text" placeholder="Category Name" name="category_name" required>
            <input class="Logininput2" type="submit" value="ADD" name="submit">
        </form>
    </section>
</body>
</html>
