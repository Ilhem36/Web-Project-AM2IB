<?php
require_once 'db_utils.php';
session_start();
connect_db();
if (isset($_POST['submit'])) {
    $email= $_POST['email'];
    $password=$_POST['password'];
    $sql="SELECT * FROM w_gene.users WHERE email='{$email}' and password='{$password}'";
    $results=pg_query($db_conn,$sql);
    $time_con = time();
    $date_con = date("m-d-Y H:i:s",$time_con );
    $update_connex=pg_query($db_conn,"UPDATE w_gene.users SET date='{$date_con}' WHERE email='{$email}' ");
    if ($results){// if result = TRUE ( we  find email and password in DB)
        $row=pg_fetch_assoc($results);
        $_SESSION["session_login"]=$row['email'];
        $_SESSION["statut"]=$row['role'];
        if ($_SESSION["statut"]=='annotator'){
        header("Location:annot_menu.php");
        }else if ($_SESSION["statut"]=='validator'){
            header("Location:Valid_Menu.php");

        }else if ($_SESSION["statut"]=='reader'){
            header("Location:reader_Menu.php");

        }else if($_SESSION["statut"]=='admin') {
            header("Location:Admin_Menu.php");
        }else {
            header("Location:signup.php");
        }
    }


}
disconnect_db();
?>


<!DOCTYPE html>

<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>
        Sign In
    </title>
    <!--link for css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">

</head>
<body>
<div class="full-page">
    <!--navigation bar-->
    <div class="navbar">
        <div>
            <a href="website.html">Genome Annotation</a>
        </div>
        <nav>
            <ul id='MenuItems'>
                <li><a href="signup.php">Sign Up</a></li>
                <li><button class='loginbtn' onclick="document.getElementById('login-form').style.display='block'" style="width:auto">Sign In </button>
                </li>
            </ul>
        </nav>
    </div>
    <div id='login-form' class="loginbox">
        <img src="login.jpg" class="avatar">
        <h1>Login Here </h1> </br>
        <form method="post" action=" ">
            <p>Username</p>
            <input type="email" name="email" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit"  href="pageform.html"></br>
            <a href="signup.php " target="_blank">Don't have an account?</a> </br>
        </form>


    </div>

</div>

</body>
</html>
