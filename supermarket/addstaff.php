<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admindash.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="Addstaff.css">
    <title>Index</title>
</head>
<body>
    <section class="Main">
            <form class="Logincontainer" action="" method="post">
                <h1>ADD STAFF</h1>
                
                <input class="Logininput1" type="text" placeholder="Name" name="name">
                <input class="Logininput1" type="email" placeholder="Email" name="email">
                <input class="Logininput1" type="number" placeholder="Phone Number" name="phnum">
                <input class="Logininput1" type="password" placeholder="Password" name="pass">
                <!-- <input class="Logininput1" type="password" placeholder="Confirm Password" name="cnfpass"> -->
                <input class="Logininput1"type="text" placeholder="position" name="position"><br>
                <input class="Logininput1" type="date" placeholder="hire_date" name="hire_date"><br>

                <input class="Logininput2" type="submit" value="ADD" name="submit">
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
    // $cnfpass=$_POST['cnfpass'];
    $position=$_POST['position'];
    $type=1;
            $sql="INSERT INTO `staff`(`name`, `email`, `phnum`, `pass`, `position`) VALUES  ('$name','$email','$phnum','$pass','$position')";
        $data=mysqli_query($conn,$sql);

        $sql1="INSERT INTO `login`(`email`, `password`, `usertype`) VALUES ('$email','$pass','$type')";
        $data1=mysqli_query($conn,$sql1);

        if($data){
            echo "<script>alert('Registration Successfull')</script>";
        }
        else{
            echo "<script>alert('Registration Failed')</script>";
        }
    }

?>