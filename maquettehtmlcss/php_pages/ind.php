<?php
require_once 'db_utils.php';
connect_db();
disconnect_db();

?>



<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
          G
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
                       <li><a href="signup.html">Sign up</a></li>
                       <li><button class='loginbtn' onclick="document.getElementById('login-form').style.display='block'" style="width:auto">Login</button>
                       </li>
                   </ul>
               </nav>
           </div>
           <div id='login-form' class="loginbox">
            <img src="login.jpg" class="avatar">
            <h1>Login Here </h1> </br>
            <form method="post" action="/WP/Web-Project-AM2IB-1/maquettehtmlcss/signin-action.php">
                <p>Username</p>
                <input type="email" name="email" placeholder="Enter Username">
                <p>Password</p>
                <input type="Password" name="Password" placeholder="Enter Password">
                <input type="submit" name="submit" value="Login" href="pageform.html">  </br>
                <a href="signin.html" target="_blank">Don't have an account?</a> </br>

                <?php
                session_start();
                $_SESSION['Username'] = $_POST['email'];
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 )
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>"; }
                ?>

            </form>


        </div>

        </div>

    </body>
</html>