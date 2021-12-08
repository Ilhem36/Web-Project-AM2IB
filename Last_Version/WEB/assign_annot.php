<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="assign.css">

</head>
<body>
<nav>
    <div class="nav-content">
    <!--navigation bar-->
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>

            <ul class="nav-links">
                <li><a href="Home_page.php">Home</a></li>
                <li><a href="#">Annotations</a></li>
                <li><a href="#">Admin</a></li>
                <li><a href="#">Validator</a></li>
                <li><a href="#">Annotator</a></li>
                <li><a href="#">Reader</a></li>
                <li><a href="signIn.php">Logout</a><br><br>

                <div class = "hello">
                    <?php require_once 'db_utils.php';
                        connect_db();
                        session_start();
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