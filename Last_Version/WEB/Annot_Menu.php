<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Annotator page</title>
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
    <p><h2> This is the Annotator page ! </h2><br>
    <p>Click on <strong>Choose a sequence to annotate</strong> to annotate a sequence. After a sequence is choosen, it leads to the Annotation form. You can check your annotations history.</p><br>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "annot_seq.php";?>'">Choose a sequence to annotate</button>
</div>

</body>
</html>
