<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Load Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
            <link href="css/styles.css" rel="stylesheet">
            <title>Home</title>
            <style>
                table, th, tr,td {
                    padding-bottom: 0px;
                 }
            </style>
        </head>
        <body>
            <header class="page__header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="create" value="Add Post" style="float:left">
                            <input type="submit" name="logout" value="Logout" style="float:right">
                            <input type="submit" name="profile" value=<?php session_start();echo $_SESSION["fname"]; ?> style="float:right">
                            
                        </ul> 
                    </form>
                </nav>
            </header>
            <main>
                <header class="main__hero">        
                    <h1 style="text-align:center">Thoughts</h1>
                </header> 
            <h3 >Posts</h3>
                <?php
                //connection
                include 'connection.php';
                
                if(isset($_POST['profile'])){
                    if (isset($_SESSION['Id'])&&isset($_SESSION['email'])){
                            header("location: profile.php");
                        }else{
                    echo '<script>alert("Please login first")</script>';
                    }
                }
                if(!isset($_SESSION ['Id'])){
                    echo  '<a href="login.php">Click here to login</a>';
                    exit();
                }
                if(isset($_SESSION ['Id'])){
                    $id= $_SESSION['Id'];
                    $name=$_SESSION['fname'];
                    
                }
                
                if(isset($_POST['view'])) {
                    $_SESSION['postid']=$row['id'];
                    header("location: posts.php");
                }
                
                if(isset($_POST['create'])) {
                    $id= $_SESSION['Id'];
                    header("location: createposts.php");
                }

                if(isset($_POST['logout'])) {
                    session_start();
                    unset($_SESSION['Id']);
                    unset($_SESSION['fname']);
                    header("Location:login.php");
                }
                
                $query3="select * from Posts inner join users where users.Id=posts.userid  ";
                $result3=mysqli_query($con,$query3);
                if(mysqli_num_rows($result3)>0){
                    while($row=mysqli_fetch_array($result3)){
                        $postid=$row['id'];
                        $title=$row['title'];
                        $body=$row['body'];
                        $name=$row['firstname']; 
                        echo"<table style='width:60%' >
                        <tr><td style='font-weight:bold'>$title</td>
                        <td style='font-weight:bold'>$body</td>
                        <td style='font-weight:bold'>$name</td>
                        <td><a href='posts.php?id=".$postid."'>Add Comment</a></td></tr></table>";
                    }
                }
                
        ?>
        </main>
    </body>
</html>