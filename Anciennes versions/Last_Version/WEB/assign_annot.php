<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<!__ This page is linked to affect_valid.php page.The 2 pages are coded to assign sequences to annotators.
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <!--Specify the character encoding for the HTML-->
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="assign.css">
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

                <br><br>
                <div class = "hello">
                    <?php
                    echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                    ?>
                </div>

            </ul>
    </div>
</nav>
</body>

<div class="container"  >

        <div class="title">Assign sequence to annotator</div><br>
    <div  align="center">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php require_once 'affect_valid.php' ?>

        </form>
    </div>
</div>
</html>