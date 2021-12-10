<?php
//This page requires the page annot_fun.php(which contains the php code) . It is dedicated for the annotator to choose the sequences to annotate.
// Connexion to database
require_once 'db_utils.php';
connect_db();
//Start session for the login
session_start(); ?>
<!DOCTYPE html>
<!-- set the language and the direction of the text-->

<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet" type="text/css" href="annot_seq.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">

</head>
<body>
<nav>
    <div class="nav-content">
        <!--navigation bar-->
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <?php require_once 'Menu.php' ; ?>
            <!--Display the navigation bar for annotators-->
            <br><br>
            <div class = "hello">
                <!-- Welcome message for the user-->
                <?php
                echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                ?>
            </div>

        </ul>
    </div>
</nav>
<div class="container">
    <div class="title"> Choose your sequence(s) </div><br>
    <div  align="center">
        <?php require_once 'anno_fun.php';?>
    </div>

</div>

</body>
</html>