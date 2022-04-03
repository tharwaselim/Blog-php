<?php
    //connection
    include 'connection.php';
    
    session_start(); 
    if(isset($_POST['Update'])){
        header("location: update.php");
    }
    if(isset($_POST['delete'])){
        $id= $_SESSION['Id'];
        $query1="delete  from users where Id='$id'";
        if(mysqli_query($con,$query1)){
            session_start();
            unset($_SESSION['Id']);
            unset($_SESSION['fname']);
            header("Location:login.php");
        }else{
            echo "Error  :".mysqli_error($con);
        }
    }
    if(isset($_POST['create'])) {
        $id= $_SESSION['Id'];
        header("location: createposts.php");
    }
    if(isset($_POST['home'])){
        header("location: thoughts.php");
    }
    if(isset($_POST['logout'])) {
        session_start();
        unset($_SESSION['Id']);
        unset($_SESSION['fname']);
        header("Location:login.php");
    }
    
    if(!isset($_SESSION['Id'])){
        echo '<script>alert("Please login first")</script>';
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
            }
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
            <style>
            body {
            font-family: Arial;
            }

            td{
                font-weight:bold;
            }

            .split {
            height:100%;
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 100px;
            overflow-x: hidden;
            padding-top: 20px;
            }

            .left {
            left: 5px;
            top: 120px;
            text-align: left;
            }

            .right {
            right: 25px;
            top: 80px;
            text-align: left;
            }

            .centered {
            position: absolute;
            top: 0;
            left: 0;
            }
            </style>
    </head>
    <header class="page__header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="home" value="Home" style="float:left">
                            <input type="submit" name="create" value="Add Post" style="float:left">
                            <input type="submit" name="logout" value="Logout" >
                           
                        </ul> 
                    </form>
                </nav>
            </header>
            <main>
            <header class="main__hero">        
                <h1 style="text-align:center">Profile</h1>
           </header> 
    <body>
        <div class="split left">
            <div class="centered">
                <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:left">
                    <table style='width:100%' style='height:100%'>
                        <tr><td style='color:rgb(236, 142, 216)'>First name</td><td ><?php echo $fname; ?></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Last name</td><td ><?php echo $lname; ?></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Address</td><td ><?php echo $add; ?></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Email</td><td ><?php echo $email; ?></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Gender</td><td ><?php if (isset($gender) && $gender=="Female"){echo "Female";}
                                        elseif(isset($gender) && $gender=="Male"){echo "Male";}?></td></tr>
                        <tr><td style='color:rgb(236, 142, 216)'>Photo</td><td ><?php echo "<img src='images/".$image."' >"; ?></td></tr>    
                        <tr><td style='color:rgb(236, 142, 216)'>Phone</td><td ><?php echo $phone; ?></td></tr>
                    </table>
                    <input type="submit" name="Update" value="Update">
                    <input type="submit" name="delete" value="Delete" >
                </form>
            </div>
        </div>

        <div class="split right">
            <div class="centered">  
            <h3  >My Posts</h3>
            <?php
                if(isset($_SESSION ['Id'])){
                    $id= $_SESSION['Id'];
                    $name=$_SESSION['fname'];
                }

                $query3="select * from Posts inner join users where (users.Id=posts.userid) and userid='$id'";
                $result3=mysqli_query($con,$query3);
                    if(mysqli_num_rows($result3)>0){
                         while($row=mysqli_fetch_array($result3)){   
                            $postid=$row['id'];
                            $title=$row['title'];
                            $body=$row['body'];
                            echo"<table style='width:100%' style='height:100%'>
                            <tr><td style='font-weight:bold'>$title</td><td style='font-weight:bold'>$body</td><td><a href='posts.php?id=".$postid."'>View</a> </td></tr></table>";     
                            }
                        }
                ?>
                </div>
            </div>
        </body>
    </main>
</html> 
