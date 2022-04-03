<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Load Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
            <link href="css/styles.css" rel="stylesheet">
            <title>All Posts</title>
        </head>
        <body>
            <header class="page__header">
                <nav class="navbar__menu">
                    <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                        <ul id="navbar__list"> 
                            <input type="submit" name="login" value="Login" >
                            <input type="submit" name="register" value="Register" >
                        </ul> 
                    </form>
                </nav>
            </header>
            <main>
            <header class="main__hero">        
                <h1 style="text-align:center">All Posts </h1>
            </header>
            <?php
                //connection
            include 'connection.php';
            $query3="select * from Posts ";
            $result3=mysqli_query($con,$query3);
            if(mysqli_num_rows($result3)>0){
                while($row=mysqli_fetch_array($result3)){
                    echo "title ".$row['title']." body : ".$row['body']." by ".$row['userid']."<br>";
                    }
                }
                if(isset($_POST['register'])){
                    header("Location:register.php");
                }
                if(isset($_POST['login'])){
                    header("Location:login.php");
                }            
             ?>
        </main>
    </body>
</html>