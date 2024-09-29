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
            <a href="Register.php"><div class="menus">Register</div></a>
        </div>
    </nav>
    <section class="Home_Section">
            <form class="Logincontainer" action="" method="post">
                <h1>Login</h1>
                <input class="Logininput1" type="email" placeholder="Email" name="email">
                <input class="Logininput1" type="password" placeholder="Password" name="pass">
                <input class="Logininput2" type="submit" value="Login" name="submit">
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
    $pass=$_POST['pass'];
    $email=$_POST['email'];
    $sql="SELECT * FROM `login` WHERE `email`='$email' AND  `password`='$pass'";
    echo "$sql";
    $data=mysqli_query($conn,$sql);
    if($data){
        $row=mysqli_num_rows($data);
        if($row > 0){
            $value=mysqli_fetch_assoc($data);
            if($value['usertype'] == 0){
            header('Location: userdash.html');
            exit();
            }
            else if($value['usertype'] == 1){
                header('Location: staffdash.html');
                exit();
            }
            else{
                header('Location: Admindash.php');
                exit();
            }
        }
    
        else{
            echo "user not found";
        }
    }
}
?>