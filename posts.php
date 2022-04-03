<?php
//connection
    include 'connection.php';
    session_start();
    if(isset($_SESSION ['Id'])){
        $id= $_SESSION['Id'];
        $name=$_SESSION['fname'];
    }else{
        echo '<script>alert("Please login first")</script>';             
        header("Location:login.php");
    }
    $idpost=$_GET['id'];
    $query3="select * from Posts where id='$idpost' ";
    $result3=mysqli_query($con,$query3);
    if(mysqli_num_rows($result3)>0){
        while($row=mysqli_fetch_array($result3)){
            $_SESSION['postid']=$row['id'];
            $title=$row['title'];
            $body=$row['body'];
        }
    }
    
    if(isset($_POST['create'])) {
        $id= $_SESSION['Id'];
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
    if(isset($_POST['update'])){
        
        $postid=$_SESSION ['postid'];
        header("location: updateposts.php");
    }
    if(isset($_POST['delete'])){
        $postid=$_SESSION ['postid'];
        $query1="delete  from posts where id='$postid'";
        if(mysqli_query($con,$query1)){
            $title="";
            $body="";
        }else{
            echo "Error  :".mysqli_error($con);
        }
    } 
        if(isset($_POST['comment'])){
            if(isset($_POST['addcomment'])){
                $comment=addslashes($_POST['comment']);
                $postid=$_SESSION ['postid'];
                $id= $_SESSION['Id'];
                $query2="insert into Comments(userid,postid,commentbody)values('$id','$postid','$comment')";
                if(mysqli_query($con,$query2)){
                    //echo "Comment Added Successfully.";
                    }else{
                        echo "Error  :".mysqli_error($con);
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
            <title>Posts</title>
            <style>
                body {
                    font-family: Arial;}

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
                    top: 180px;
                    text-align: left;
                }

                .right {
                    right: 25px;
                    top: 180px;
                    text-align: left;
                }

                .centered {
                position: absolute;
                top: 0;
                left: 0;
                }
            </style>
        </head>
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
            <h1 style="text-align:center">Posts</h1>
           </header> 
            <body>
            <div class="split left">
                <div class="centered">
                    <form id="myFormId" method="post" action="<?php $_PHP_SELF ?>">
                        <label><?php echo $title; ?></label>
                        <input type="text" name="post" value="<?php echo $body; ?>" disabled="disabled"><br><br>
                        <input type="text" name="comment" style="width: 500px" style="height:400px"style="padding: 12px 20px"
                        style="box-sizing: border-box"style="resize: none">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type="submit" name="addcomment" value="Add Comment"><br><br>
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="delete" value="Delete"><br><br>
                    </form>
            
                </div>
            </div>
            <div class="split right">
                <div class="centered">           
                    <h3  >Comments</h3>
                    <?php
                    $postid=$_SESSION ['postid'];
                    $query4="select * from comments  where postid='$postid' ";
                    $result4=mysqli_query($con,$query4);
                        if(mysqli_num_rows($result4)>0){
                            while($row=mysqli_fetch_array($result4)){   
                                $commentbody=$row['commentbody'];
                                echo"<table style='width:100%' ><tr>
                                <td style='font-weight:bold'>$commentbody</td>
                               
                                </tr></table>";
                        }                        
                    }
                    
                    ?>
                    </div>
            </div>
        </main>
    </body>
</html>