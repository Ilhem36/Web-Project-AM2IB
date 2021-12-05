<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>
        Genote
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
            <a href="website.html">Genote</a>
        </div>
        <nav>
            <ul id='MenuItems'>
                <li><a href="genomeform.html">Form Genome</a></li>
                <li><a href="GeneProtform.html">Form Gene/Protein</a></li>
                <li><a href="Annotatorpage.php" target="_blank">Annotator</a></li>
                <li><a href="Validatorpage.php" target="_blank">Validator</a></li>
                <li><a href="adminpage.html">Administrator</a></li>
            </ul>
        </nav>
    </div>
    <div class="container" >
    <div  align="center">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php require_once 'affect_valid.php'; ?>
        </form>
    </div>
    </div>
</div>

</body>
</html>