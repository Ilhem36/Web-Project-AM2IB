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
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="annot_in_progress.php">Annotations</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a>
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

<div class ="container">
    <p><h2> This is the Annotator page ! </h2><br>
    <p>Click on <strong>Choose a sequence to annotate</strong> to annotate a sequence. After a sequence is choosen, it leads to the Annotation form. You can check your annotations history by clicking on <strong>Annotation history</strong>.</p><br>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "annot_seq.php";?>'">Choose a sequence to annotate</button>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "historique.php";?>'">Annotation <br>history</button>
</div>

</body>
</html>
