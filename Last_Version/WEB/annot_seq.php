<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<!-- html of annot_fun php page  -->
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
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="annot_in_progress.php">Annotations</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a></li>
            <li><a href="signIn.php">Logout</a>
                <br>
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
<div class="container">
    <div class="title"> Choose your sequence(s) </div><br>
    <div  align="center">
        <?php require_once 'anno_fun.php';?>
    </div>

</div>

</body>
</html>