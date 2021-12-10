<?php
require_once 'db_utils.php';
connect_db(); //connexion to the database
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!--This is the validator home page-->
    
<head>
    <meta charset="utf-8" />
    <title>Validator page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>

<body>
<nav><!--Navigation menu-->
    <div class="nav-content">
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

<div class ="container">
    <p><h2> This is the Validator page ! </h2><br>
    <p>Click on <strong>Assign annotation</strong> to assign an annotation to an annotator and on <strong>Valid/Reject annotation</strong> to valid or reject an annotation</p><br>
    <button class='btn btn--assign' type='submit' onclick="location.href='<?php echo"assign_annot.php";?>'">Assign <br> Annotation</button>
    <button class='btn btn--assign' type='submit' onclick="location.href='<?php echo"validation_space.php";?>'">Valid/Reject annotation</button>
</div>


</body>
</html>
<?php
disconnect_db(); //deconnexion from the database
?>
