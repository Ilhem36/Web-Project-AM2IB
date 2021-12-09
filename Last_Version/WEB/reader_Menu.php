<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Reader page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>

<body>
<nav> <!--Navigation menu-->
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="annot_in_progress.php">Annotations</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
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
    <p><h2> This is the Reader page ! </h2><br>
    <p>Click on the <strong>Genomes Form</strong> to access to the genomes search form and on the <strong>Genes/Prot Form</strong> to access to the genes and proteins search form</p><br>
    <p> You can search and read information about bacterial genomes, genes and peptides from the database. If needed, you can also download your search results pages.</p>
    <br>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "Form_genome.php";?>'">Genome Search <br>Form</button>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "Form_cds.php";?>'">Gene and Protein Search Form</button>
</div>

</body>
</html>
