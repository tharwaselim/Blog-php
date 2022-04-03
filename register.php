<?php
    //connection
    include 'connection.php';

    if(isset($_POST['login'])){
        header("Location:login.php");
    }
    if(isset($_POST['home'])){
        header("Location:welcome.php");
    }
    if(isset($_POST['register'])){
        $fname=addslashes($_POST['fname']);
        $lname=addslashes($_POST['lname']);
        $address=addslashes($_POST['address']);
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $image=$_POST['img'];
        $phone=$_POST['phone'];
        $password=addslashes($_POST['password']);

        $query1= "select * from users where email = '$email'";
        $result1=mysqli_query($con,$query1);
        if(mysqli_num_rows($result1)==1){
            $row=mysqli_fetch_assoc($result1);
            if($row['email']===$email ) {
                echo '<script>alert("email already exists")</script>';
                }
            }
            $query="insert into users(firstname,lastname,address,email,Gender,Image,phone,password)values('$fname','$lname','$address','$email','$gender','$image','$phone','$password')";
            if(mysqli_query($con,$query)){              
    }
        }       
            ?>
            <!DOCTYPE html>
                <html>
                    <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <!-- Load Google Fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
                    <link href="css/styles.css" rel="stylesheet">
                        <title>Register</title>
                        </head>
                <body>
                <header class="page__header">
                        <nav class="navbar__menu">
                            <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                                <ul id="navbar__list"> 
                                    <input type="submit" name="home" value="Home"style="float:left">
                                    <input type="submit" name="login" value="Login">    
                                </ul> 
                            </form>
                        </nav>    
                    </header>
                    <header class="main__hero"> 
                        <h1 style="text-align:center">Register</h1>
                    </header>
                    <main>
                        <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:left"> 
                            <table style='width:60%' style='height:100%'>
                                <tr><td style='color:rgb(236, 142, 216)'>First name</td><td ><input type="text" name="fname"required></td></tr>
                                <tr><td style='color:rgb(236, 142, 216)'>Last name</td><td ><input type="text" name="lname"required></td></tr>
                                <tr><td style='color:rgb(236, 142, 216)'>Address</td><td ><input type="text" name="address"required></td></tr>
                                <tr><td style='color:rgb(236, 142, 216)'>Email</td><td ><input type="email" name="email" required></td></tr>
                                <tr><td style='color:rgb(236, 142, 216)'>Gender</td><td ><input type="radio" name="gender"style="accent-color: #25030f" value="Male"required>Male
                                                   <input type="radio" name="gender"style="accent-color: #25030f" value="Female">Female </td></tr>
                                <tr><td style='color:rgb(236, 142, 216)'>Photo</td><td ><input type="file"  name="img" accept="image/*" ></td></tr>           
                                <tr><td style='color:rgb(236, 142, 216)'>Phone</td><td ><input type="number" name="phone"required></td></tr>    
                                <tr><td style='color:rgb(236, 142, 216)'>Password</td><td ><input type="password" name="password" required></td></tr>
                            </table>
                           
                            <input type="submit" name="register" value="Register">
                            <input type="reset" name="reset" value="Reset"><br>
                            <?php 
                            if(isset($_POST['register'])){
                                echo "Welcome you are now registered.";
                                echo  '<a href="login.php">Click here to login</a>';
                            } ?>
                        </form>
                </main>
            </body>
        </html>