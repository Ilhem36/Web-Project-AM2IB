
<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
          Genome Annotation 
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
                       <li><a href="signup.php">Sign up</a></li>
                       <li><button class='loginbtn' onclick="document.getElementById('login-form').style.display='block'" style="width:auto">Login</button>
                       </li>
                   </ul>
               </nav>
           </div>
           <div id='login-form' class="loginbox">
            <img src="login.jpg" class="avatar">
            <h1>Login Here </h1> </br>
            <form action="verification.php" method="POST">
                <p>Email</p>
                <input type="text" name="Email" placeholder="Enter email">
                <p>password</p>
                <input type="password" name="Password" placeholder="Enter Password">
                <input type="submit" name="submit" value="Login">  </br>
                <a href="#">Lost your password?</a> </br>
                <a href="signup.php" target="_blank">Don't have an account?</a> </br>
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>


            </form>

    
        </div>
    
        </div>

    </body>
</html>