


<!DOCTYPE html>
<html>
<head>
    <title>VIEW ITEMS</title>
    <link rel="stylesheet" href="manageuser.css">
</head>
<body>
    <nav class="ViewCandidatesNav">
        <h1 class="ViewCandidatesNavHeading">VIEW ITEMS</h1>
        <div class="ViewCandidatesNavContainer">
            <a href="staffdash.php">Home</a>
        </div>
    </nav>
    <div class="ViewCandidatesBodyContainer">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
        if (!$conn) {
            echo "Database not connected";
        }


         
        $sql = "SELECT * FROM items"; 
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>name</th>";
            echo "<th>category</th>";
            echo "<th>price</th>";
            echo "<th>quantity</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($data)) {
                $id = $row['id'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <button value='$id' name='itemdel' type='submit'>Delete</button>
                        </form>
                        <form method='post' action='itemedit.php' style='display:inline;'>
                            <button value='{$id}' name='itemedit' class='edititem' type='submit'>EDIT</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No items found.";
        }
        ?>
    </div>
</body>
</html>

<?php

if (isset($_POST['itemdel'])) {
    $id = $_POST['itemdel'];
    if (!empty($id)) {
        $sql = "DELETE FROM items WHERE id='$id'"; 
        $data = mysqli_query($conn, $sql);
        if ($data) {
            echo "<script>window.location.replace('staffitem.php');</script>";
        } else {
            echo "Error deleting item: " . mysqli_error($conn);
        }
    }
}


mysqli_close($conn);
?>

