
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Sticky Navigation Bar | CodingLab </title>
    <link rel="stylesheet" href="home_page.css">
</head>

<body>
<!-- pour la barre de navigation -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Form</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
            <li><a href="#">Reader</a></li>
            <li><a href="signIn.php">Logout</a>

</html>

</ul>
</div>
</nav>
<section class="home"></section>

<?php
session_start();
echo 'welcome ' .$_SESSION["session_login"];?>

</body>
</html>
