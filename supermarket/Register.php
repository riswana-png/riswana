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
        <h1>Super Market Management Sysytem </h1>
        <div class="Nav_menus">
            <!-- <div class="menus">Home</div>
            <div class="menus">Login</div> -->
            <a href="index.html"><div class="menus">Home</div></a>
            <a href="Login.php"><div class="menus">Login</div></a>
        </div>
    </nav>
    <section class="Home_Section">
            <form class="Logincontainer" action="" method="post">
                <h1>Register</h1>
                
                <input class="Logininput1" type="text" placeholder="Name" name="name">
                <input class="Logininput1" type="email" placeholder="Email" name="email">
                <input class="Logininput1" type="number" placeholder="Phone Number" name="phnum">
                <input class="Logininput1" type="password" placeholder="Password" name="pass">
                <input class="Logininput1" type="password" placeholder="Confirm Password" name="cnfpass">
                <input class="Logininput2" type="submit" value="Register" name="submit">
            </form>
    </section>
</body>
</html>

<?php
$conn=mysqli_connect("localhost","root","","supermarket_management_system");
if(!$conn){
    echo "DB connection failed";
}
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phnum=$_POST['phnum'];
    $pass=$_POST['pass'];
    $cnfpass=$_POST['cnfpass'];
    $type=0;
    if($pass == $cnfpass){
        $sql="INSERT INTO `users`(`name`, `email`, `phonenum`, `password`) VALUES ('$name','$email','$phnum','$pass')";
        $data=mysqli_query($conn,$sql);

        $sql1="INSERT INTO `login`(`email`, `password`, `usertype`) VALUES ('$email','$pass','$type')";
        $data1=mysqli_query($conn,$sql1);

        if($data && $data1){
            echo "<script>
            alert('Registration Successfull')
            </script>";
            header('Location: Login.php');
        }
        else{
            echo "<script>alert('Registration Failed')</script>";
        }
    }
}
?>