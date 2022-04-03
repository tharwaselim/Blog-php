<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Load Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
            <link href="css/styles.css" rel="stylesheet">
            <title>Login</title>
        </head>
        <body>
        <header class="page__header">
             <nav class="navbar__menu">
                  <form method="post" action="<?php $_PHP_SELF ?>" style="text-align:center">
                     <ul id="navbar__list"> 
                            <input type="submit" name="home" value="Home" style="float:left"> 
                            <input type="submit" name="register" value="Register" >
                    </ul> 
                 </form>
            </nav>
        </header>
                  
        <main>
            <header class="main__hero">        
                  <h1 style="text-align:center">Login</h1>
            </header>
            <div>
                <form method="post" action="login.php" style="text-align:center" >
                    <label for="mail">Enter your Email:</label><br>
                    <input type="email" id="mail" name="email" placeholder="Enter your Email" required><br><br>  
                    <label >Enter your Password:</label><br>
                    <input type="password" name="password" placeholder="Enter your Password" required><br><br>
                    <input type="submit" name="login" value="Login" >
                </form>
            </div>
           
            <?php
            //connection
            include 'connection.php';

            session_start();
            if(isset($_POST['register'])){

                header("Location:register.php");
            }
            if(isset($_POST['home'])){

                header("Location:welcome.php");
            }
            if(isset($_POST['login'])){
                $email=$_POST['email'];
                $password=addslashes($_POST['password']);
                $query= "select * from users where email = '$email' and password = '$password'";
                $result=mysqli_query($con,$query);
                if(mysqli_num_rows($result)==1){
                    $row=mysqli_fetch_assoc($result);
                    if($row['email']===$email && $row['password']===$password) {
                        $_SESSION['email']=$row['email'];
                        $_SESSION['Id']=$row['Id'];
                        $_SESSION['fname']=$row['firstname'];
                        header("location: Thoughts.php");
                    }     
                }else{
                    echo "invalid email or password";
                }
            }
        ?>
        </main>
    </body>
</html>