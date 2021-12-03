<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<!-- html of annot_fun php page  -->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>
        Genote
    </title>
    <!--link for css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">

</head>
<body>
<div class="full-page">
    <!--navigation bar-->
    <div class="navbar">
        <div>
            <a href="website.html">Genome Annotation</a>
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
    <div class="container">
        <?php require_once 'anno_fun.php';?>
    </div>

</div>

</body>
</html>