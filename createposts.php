<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Load Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
            <link href="css/styles.css" rel="stylesheet">
            <title>Create Posts</title>
        </head>
        <body>
        <header class="page_header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="home" value="Home" style="float:left">
                            <input type="submit" name="profile" value=<?php session_start();echo $_SESSION["fname"]; ?> >
                            <input type="submit" name="logout" value="Logout" >                        
                        </ul> 
                    </form>
                </nav>
               
            </header>
            <header class="main__hero"> 
                <h1 style="text-align:center">Create Post</h1>
            </header>
            <form id="myFormId" method="post" action="<?php $_PHP_SELF ?>">
                <label>Title:</label><input type="text" name="title" required> <br><br>
                <label>Body:</label><input type="text" name="body" required><br><br>
                <input type="submit" name="create" value="Create" style="text-align:center">
            </form>
        </body>
    </html>
    <?php
        //connection
        include 'connection.php';

        if(!isset($_SESSION['Id'])){
            echo '<script>alert("Please login first")</script>';
            echo  '<a href="login.php">Click here to login</a>';
        }
        if(isset($_SESSION['Id'])) {
            $id= $_SESSION['Id'];
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
        if(isset($_POST['create'])){
            if (isset($_POST['title'])&&isset($_SESSION['email'])){
            $id= $_SESSION['Id'];
            $title=addslashes($_POST['title']);
            $body=addslashes($_POST['body']);
            $query="insert into posts(userid,title,body)values('$id','$title','$body')";

            if(mysqli_query($con,$query)){
                //echo "Record Created Successfully.";
            }else{
                echo "Error  :".mysqli_error($con);
            }
        }
        else {
            header("location: thoughts.php");
        } 
    }
        
    ?>