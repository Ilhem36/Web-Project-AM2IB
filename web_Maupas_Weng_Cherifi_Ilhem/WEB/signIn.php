<!DOCTYPE html>
<!-- This page is the login page -->
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Sign In </title>
    <!--link for css file -->
    <link rel="stylesheet" type="text/css" href="seconnecter.css">
</head>
<body>
<!-- pour la barre de navigation (home) -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="signIn.php">Sign In</a></li>
        </ul>
    </div>
</nav>
</body>

    <div id='login-form' class="loginbox">
        <img src="login.jpg" class="avatar">
        <h1> Login Here </h1> </br>
        <form method="post" action="">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Sign In"></br>
            <?php
            //Connection to database
            require_once 'db_utils.php';
            session_start();
            connect_db();
            if (isset($_POST['submit'])) {
                $email= $_POST['email'];
                $password=$_POST['password'];
                //Check that the email and the password of the user are in the database
                $sql="SELECT * FROM w_gene.users WHERE email='{$email}' and password='{$password}'";
                $results=pg_query($db_conn,$sql);
                //Update the time of connexion of the user
                $time_con = time();
                $date_con = date("m-d-Y H:i:s",$time_con );
                $update_connex=pg_query($db_conn,"UPDATE w_gene.users SET date='{$date_con}' WHERE email='{$email}' ");
                if (pg_num_rows($results)!=0){// if result = TRUE ( we  find email and password in DB)
                    $row=pg_fetch_assoc($results);
                    $_SESSION["session_login"]=$row['email'];
                    $_SESSION["statut"]=$row['role'];
                    //check the role and navigate to the appropriate page accoding to the role of each user
                    if ($_SESSION["statut"]=='annotator'){
                        header("Location:Annot_Menu.php");
                        die;
                    }else if ($_SESSION["statut"]=='validator'){
                        header("Location:Validator_Menu.php");
                        die;

                    }else if ($_SESSION["statut"]=='reader'){
                        header("Location:reader_Menu.php");
                        die;

                    }else if($_SESSION["statut"]=='admin') {
                        header("Location:adminpage2.php");
                        die;
                    }
                }else {
                    echo "<p>Username/password is incorrect.</p><br/>";

                }


            }
            ?>
            <a href="signup.php " target="_blank">Don't have an account?</a> </br>
        </form>

    </div>
</html>
<?php   disconnect_db(); //deconnexion from the database ?>