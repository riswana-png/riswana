<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body>
    <nav class="navbar">
        <h1>Super Market Management System</h1>
        <div class="Nav_menus">
            <a href="index.html"><div class="menus">Home</div></a>
            <a href="Register.php"><div class="menus">Register</div></a>
        </div>
    </nav>
    <section class="Home_Section">
        <form class="Logincontainer" action="" method="post">
            <h1>Login</h1>
            <input class="Logininput1" type="email" placeholder="Email" name="email" required>
            <input class="Logininput1" type="password" placeholder="Password" name="pass" required>
            <input class="Logininput2" type="submit" value="Login" name="submit">
        </form>
    </section>
</body>
</html>

<?php
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("DB connection failed");
}

if (isset($_POST['submit'])) {
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Query to check credentials in login table
    $sql = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$pass'";
    $data = mysqli_query($conn, $sql);

    if ($data) {
        $row = mysqli_num_rows($data);
        if ($row > 0) {
            $value = mysqli_fetch_assoc($data);
            $userType = $value['usertype'];
            
            if ($userType == 0) { // Regular User
                $userSql = "SELECT * FROM `users` WHERE `email`='$email'";
                $userData = mysqli_query($conn, $userSql);
                if ($userData) {
                    $userDetails = mysqli_fetch_assoc($userData);
                    $_SESSION['user_id'] = $userDetails['userid']; // Store user ID in session
                    header('Location: userdash.html');
                    exit();
                }
            } else if ($userType == 1) { // Staff
                $staffSql = "SELECT * FROM `staff` WHERE `email`='$email'";
                $staffData = mysqli_query($conn, $staffSql);
                if ($staffData) {
                    $staffDetails = mysqli_fetch_assoc($staffData);
                    $_SESSION['staff_id'] = $staffDetails['userid']; // Store staff ID in session
                    header('Location: staffdash.php');
                    exit();
                }
            } else { // Admin
                $_SESSION['admin_id'] = $value['id']; 
                header('Location: Admindash.php');
                exit();
            }
        } else {
            echo "User not found";
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
