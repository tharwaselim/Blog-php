<?php 
$servername="localhost";
                $username="root";
                $pw="";
                $db="blog";

                $con=mysqli_connect($servername,$username,$pw,$db);
                if (!$con){
                    die("Connection Failed: ".mysqli_connect_error());
                }else{
                    //echo "Connection Successfully";
                }
?>