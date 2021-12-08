<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Validator page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>

<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="Validator_Menu.php">Validator</a></li>
            <li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a>
            </li>
            <li><a href="signIn.php">Logout</a>
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

<div class ="container">
    <p><h2> This is the Validator page ! </h2><br>
    <p>Click on <strong>Assign annotation</strong> to assign an annotation to an annotator and on <strong>Valid/Reject annotation</strong> to valid or reject an annotation</p><br>
    <button class='btn btn--assign' type='submit' onclick="location.href='<?php echo"assign_annot.php";?>'">Assign <br> Annotation</button>
    <button class='btn btn--assign' type='submit' onclick="location.href='<?php echo"validation_space.php";?>'">Valid/Reject annotation</button>
</div>


</body>
</html>
