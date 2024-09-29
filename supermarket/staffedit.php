<html>
<head>
    <title>MANAGE STAFF</title>
    <link rel="stylesheet" href="manageuser.css">
</head>
<body>
    <nav class="ViewCandidatesNav"> 
        <h1 class="ViewCandidatesNavHeading">MANAGE STAFF</h1>
        
        <div class="ViewCandidatesNavContainer">
            <a href="Admindash.php">Home</a>
        </div>
    </nav>

<?php
// Initialize userDetails
$userDetails = null;

// Check if 'staffedit' is set in the POST request
if (isset($_POST['staffedit'])) {
    $id = $_POST['staffedit'];
    $conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");

    if ($conn) {
        $sql = "SELECT * FROM `staff` WHERE `userid`='$id'";
        $data1 = mysqli_query($conn, $sql);

        // Check if query was successful
        if ($data1) {
            $userDetails = mysqli_fetch_assoc($data1);

            if ($userDetails) {
                if (isset($_POST['staffediting'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $phno = $_POST['phno'];
                    $passwd = $_POST['password'] ? $_POST['password'] : $userDetails['pass']; // Keep current password if empty
                    $position = $_POST['pos'];

                    // Update user details
                    $profileUpdateSql = "UPDATE `staff` SET `name`='$username', `email`='$email', `phnum`='$phno', `pass`='$passwd', `position`='$position' WHERE `userid`='$id'";
                    
                    if (mysqli_query($conn, $profileUpdateSql)) {
                        echo "<script>alert('Update successful'); window.location.href='managestaff.php';</script>";
                        exit();
                    } else {
                        echo "<script>alert('Update Failed: " . mysqli_error($conn) . "');</script>"; // Show error message
                    }
                }
            } else {
                echo "<script>alert('User not found');</script>";
            }
        } else {
            echo "<script>alert('Query execution failed');</script>";
        }
    } else {
        echo "<script>alert('Database connection failed.');</script>";
    }   
}
?>

<form method="post">
    <input required class="inp" type="hidden" name="staffedit" value="<?php echo isset($userDetails['userid']) ? htmlspecialchars($userDetails['userid']) : ''; ?>">
    <table>
        <tr>
            <td>Staff Name:</td>
            <td><input required class="inp" type="text" name="username" value="<?php echo isset($userDetails['name']) ? htmlspecialchars($userDetails['name']) : ''; ?>" placeholder="Fullname"></td>
        </tr>
        <tr>
            <td>Email-ID:</td>
            <td><input required class="inp" type="email" name="email" value="<?php echo isset($userDetails['email']) ? htmlspecialchars($userDetails['email']) : ''; ?>"></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input required class="inp" type="text" name="phno" value="<?php echo isset($userDetails['phnum']) ? htmlspecialchars($userDetails['phnum']) : ''; ?>"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input class="inp" type="password" name="password" placeholder="Leave blank to keep current"></td>
        </tr>
        <tr>
            <td>Position:</td>
            <td><input required class="inp" type="text" name="pos" value="<?php echo isset($userDetails['position']) ? htmlspecialchars($userDetails['position']) : ''; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><button id="hero_bt" type="submit" name="staffediting">Update</button></td>
        </tr>
    </table>
</form>
</body>
</html>
