<?php
   //connection
   include 'connection.php';
    session_start();
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
    if(isset($_SESSION ['postid'])){
        $postid=$_SESSION ['postid'];
        $query3="select * from Posts where id='$postid'";
        $result3=mysqli_query($con,$query3);
        if(mysqli_num_rows($result3)>0){
            while($row=mysqli_fetch_array($result3)){
                $title=$row['title'];
                //echo $title;
                $body=$row['body'];
                $userid=$row['userid'];

            }
        }
    }
    if(isset($_POST['update'])){
        if(isset($_POST['title'])&&isset($_POST['body'])) {
            $id=$_SESSION ['Id'];
            $id=$_SESSION ['Id'];
            if($id==$userid){

            $title=addslashes($_POST['title']);
            $body=addslashes($_POST['body']);
            $query="update posts set title='$title',body='$body' where id='$postid'";
            if(mysqli_query($con,$query)){
                //echo "Record Updated Successfully.";
            }else{
                echo "Error  :".mysqli_error($con);
            }

        } else{
            echo '<script>alert("You are not permited to update this post ")</script>';    
        }
        }else {
            header("location: profile.php");
        }
    }

    if(!isset($_SESSION ['Id'])){
        echo  '<a href="login.php">Click here to login</a>';exit();
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
            <title>Create Posts</title>
        </head>
        <body>
        <header class="page_header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="home" value="Home" style="float:left">
                            <input type="submit" name="profile" value=<?php echo $_SESSION["fname"]; ?> >
                            <input type="submit" name="logout" value="Logout" >                        
                        </ul> 
                    </form>
                </nav>     
            </header>
            <header class="main__hero"> 
                <h1 style="text-align:center">Update Post</h1>
                <form id="myFormId" method="post" action="<?php $_PHP_SELF ?>">
                    <label>Title:</label><input type="text" name="title" value="<?php echo $title; ?>" required><br><br>
                    <label>Body:</label><input type="text" name="body" value="<?php echo $body; ?>"required><br><br>
                    <input type="submit" name="update" value="Update"><br><br>
                </form>
            </header>
        </body>
    </html>  