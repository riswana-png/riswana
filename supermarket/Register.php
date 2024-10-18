<?php
$conn = mysqli_connect("localhost", "root", "", "supermarket_management_system");
if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phnum = $_POST['phnum'];
    $pass = $_POST['pass'];
    $cnfpass = $_POST['cnfpass'];
    $type = 0;

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    } else {
        $email_check = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $email_check);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email already exists.";
        }
    }

    if (empty($phnum) || !preg_match('/^[6789]\d{9}$/', $phnum)) {
        $errors[] = "Phone number must be a valid 10-digit Indian number starting with 7, 8, or 9.";
    }

    if (empty($pass) || strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[a-z]/', $pass) || !preg_match('/[\W_]/', $pass)) {
        $errors[] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one special character.";
    }

    if ($pass !== $cnfpass) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO `users`(`name`, `email`, `phonenum`, `password`) VALUES ('$name','$email','$phnum','$pass')";
        $data = mysqli_query($conn, $sql);

        $sql1 = "INSERT INTO `login`(`email`, `password`, `usertype`) VALUES ('$email','$pass','$type')";
        $data1 = mysqli_query($conn, $sql1);

        if ($data && $data1) {
            echo "<script>alert('Registration Successful');</script>";
            header('Location: Login.php');
            exit();
        } else {
            echo "<script>alert('Registration Failed');</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}

mysqli_close($conn);
?>
