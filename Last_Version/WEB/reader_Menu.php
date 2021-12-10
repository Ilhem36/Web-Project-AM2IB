
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!--This is the reader home page-->
    
<head>
    <meta charset="utf-8" />
    <title>Reader page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>
<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<body>
<nav> <!--Navigation menu-->
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
    <p><h2> This is the Reader page ! </h2><br>
    <p>Click on the <strong>Genomes Form</strong> to access to the genomes search form and on the <strong>Genes/Prot Form</strong> to access to the genes and proteins search form.</p><br>
    <p>You can also click on <strong>Annotations in the process of validation</strong> to see the annotations being validated. You can search and read information about bacterial genomes, genes and peptides from the database. If needed, you can also download your search results pages.</p>
    <br>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "Form_genome.php";?>'">Genome Search <br>Form</button>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "Form_cds.php";?>'">Gene and Protein Search Form</button>
    <button class='btn btn--assign' type='submit' onclick = "location.href = '<?php echo "annot_in_progress.php";?>'">Annotations in the process of validation</button>
</div>

</body>
</html>
<?php
disconnect_db(); //deconnexion from the database
?>
