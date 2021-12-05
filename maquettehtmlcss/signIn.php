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
        die;
        }else if ($_SESSION["statut"]=='validator'){
            header("Location:Valid_Menu.php");
            die;

        }else if ($_SESSION["statut"]=='reader'){
            header("Location:Menu.php");
            die;

        }else if($_SESSION["statut"]=='admin') {
            header("Location:Admin_Menu.php");
            die;
        }else {
            header("Location:signup.php");
            die;
        }
    }


}
disconnect_db();
?>

<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title> Sign In </title>
    <!--link for css file -->
    <link rel="stylesheet" type="text/css" href="seconnecter.css">
<body>
    <div id='login-form' class="loginbox">
        <img src="login.jpg" class="avatar">
        <h1> Login Here </h1> </br>
        <form method="post" action="">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Sign In"></br>
            <a href="signup.php " target="_blank">Don't have an account?</a> </br>
        </form>

    </div>
</body>
</head>
</html>
