
<?php
        //connection
    include 'connection.php';
    
    session_start();
    if(isset($_POST['create'])) {$id= $_SESSION['Id'];
        header("location: createposts.php");
    }
    if(isset($_POST['home'])){
        header("location: thoughts.php");
    }
    if(isset($_POST['profile'])){
        if (isset($_SESSION['Id'])&&isset($_SESSION['email'])){
                header("location: profile.php");
            }else{
        echo '<script>alert("Please login first")</script>';
        }
    }
    if(isset($_POST['logout'])) {
        session_start();
        unset($_SESSION['Id']);
        unset($_SESSION['fname']);
        header("Location:login.php");
    }

    if(!isset($_SESSION['Id'])){echo '<script>alert("Please login first")</script>';
        $fname="";
        $lname="";
        $add="";
        $email="";
        $gender="";
        $image="";
        $phone="";
        $password="";
        echo  '<a href="login.php">Click here to login</a>';
    }
    if(isset($_SESSION['Id'])) {
        $id= $_SESSION['Id'];
        $query="select * from users where Id='$id'";
        $result=mysqli_query($con,$query);
        
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
                $fname=$row['firstname'];
                $lname=$row['lastname'];
                $add=$row['address'];
                $email=$row['email'];
                $gender=$row['Gender'];
                $image=$row['Image'];
                $phone=$row['phone'];
                $password="";  
            }
        }
    }
        
    if(isset($_POST['Update'])){
        
        $fname=addslashes($_POST['fname']);
        $lname=addslashes($_POST['lname']);
        $address=addslashes($_POST['address']);
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $phone=$_POST['phone'];
        $password=addslashes($_POST['password']);
        if($image=="female"|| $image=="male"){
            $image=$_POST['img'];
        }
        $query="update users set firstname='$fname',lastname='$lname',address='$address',email='$email',Gender='$gender' ,Image='$image' ,phone='$phone' ,password='$password' where Id='$id'";
        if(mysqli_query($con,$query)){
            header("Location:profile.php");
            //echo "Record Updated Successfully.";
        }else{
            echo "Error  :".mysqli_error($con);
        }
    }
    if(isset($_POST['delete'])){
        $query1="delete  from users where Id='$id'";
        if(mysqli_query($con,$query1)){
            //echo "Profile deleted Successfully.";
        }else{
            echo "Error  :".mysqli_error($con);
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
                <title>Profile</title>
                </head>
        <body>
        <header class="page_header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="home" value="Home" style="float:left">
                            <input type="submit" name="create" value="Add Post" style="float:left">
                            
                            <input type="submit" name="profile" value=<?php echo $_SESSION["fname"]; ?> >
                            <input type="submit" name="logout" value="Logout" >                        
                        </ul> 
                    </form>
                </nav>
               
            </header>
                <header class="main__hero"> 
                <h1 style="text-align:center">Profile</h1>
            </header>
            <main>
                <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:left">
                    <table style='width:60%' style='height:100%'>
                        <tr><td style='color:rgb(236, 142, 216)'>First name</td><td ><input type="text" name="fname" value="<?php echo $fname; ?>" ></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Last name</td><td ><input type="text" name="lname" value="<?php echo $lname; ?>"></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Address</td><td ><input type="text" name="address" value="<?php echo $add; ?>"></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Email</td><td ><input type="email" name="email" value="<?php echo $email; ?>"></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Gender</td><td ><input type="radio" name="gender" value="Male" style="accent-color: #25030f"<?php echo ($gender == 'Male') ?  "checked" : "" ;  ?>/> Male 
                                 <input type="radio" name="gender" value="Female" style="accent-color: #25030f"<?php echo ($gender == 'Female') ? "checked" : "" ;  ?>/> Female </td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Photo</td><td ><?php echo "<img src='images/".$image."' >"; ?><input type="file"  name="img" accept="image/*" ></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Phone</td><td ><input type="text" name="phone" value="<?php echo $phone; ?>" ></td></tr>    
                        <tr><td style='color:rgb(236, 142, 216)'>Password</td><td ><input type="password" name="password" value="<?php echo $password; ?>" required></td></tr>
                    </table>
                    <input type="submit" name="Update" value="Update">
                    <input type="submit" name="delete" value="Delete" >
                </form>
            </main>
    </body>     
</html>