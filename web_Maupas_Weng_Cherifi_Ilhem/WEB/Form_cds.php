<?php
//This page is the Form for genes and proteins
require_once 'db_utils.php';
connect_db(); //connexion to the database
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
        <title> CDS and Peptides Search Form </title>
    <link rel="stylesheet" type="text/css" href="reader.css">
</head>
<body>
<!-- Navigation menu -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <!--Display the navigation bar for annotators-->
            <?php require_once 'Menu.php' ; ?>

            <br><br>
            <div class = "hello">
                <!-- Welcome message for the user -->
                <?php
                echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                ?>
            </div>
        </ul>
    </div>
</nav>

<!-- The user can search information by filling information in the fields in this form-->
<!-- This form refers to Search_cds.php, where we prepare the SQL queries on the SQL tables Annotation and sequence from w_gene Database -->
<div class ="container">
    <div class="title"> Search information about Genes & Peptides </div><br>
    <form action="Search_cds.php" method="post"><!--method post-->
        <div class="form-details">
            <div class = "input-box">

                <!--Table sequence-->
                <strong>Sequence ID :</strong>
                <input type="text" placeholder="Enter the sequence ID" name="idsequence"><br><br>

                <strong>Accession Number (Genome) :</strong>
                <input type="text" placeholder="Enter the accession number" name="accessionnb"><br><br>

                <strong>DNA type :</strong>
                <input type="text" placeholder="Enter chromosome or plasmid" name="dna_type">

                <strong>CDS start position :</strong>
                <input type="text" placeholder="Enter the CDS start position" name="cds_start"><br><br>

                <strong>CDS end position :</strong>
                <input type="text" placeholder="Enter the CDS end position" name="cds_end"><br><br>

                <strong>Strand :</strong>
                <input type="text" placeholder="Enter 1 (direct) or -1 (indirect) strand" name="strand"><br><br>

                <strong>CDS sequence :</strong><br>
                <textarea id="textarea" rows="3" cols="45" name="cds_seq" placeholder = "Enter the CDS sequence" minlength="9" maxlength="27000"></textarea><br><br>

                <strong>CDS length :</strong>
                <input type="text" placeholder="Enter the CDS length" name="cds_size"><br><br>

                <strong>Peptide sequence :</strong><br>
                <textarea id="textarea" rows="3" cols="45" name="pep_seq" placeholder = "Enter the pep. sequence" minlength="3" maxlength="9000"></textarea><br><br>

                <strong>Peptide size :</strong>
                <input type="text" placeholder="Enter the pep. size" name="pep_size"><br><br>

                <!--Annotation Table-->
                <strong>Gene ID :</strong>
                <input type="text" placeholder="Enter the gene ID" name="geneid"><br><br>

                <strong>Gene Biotype :</strong>
                <input type="text" placeholder="Enter the gene biotype" name="genebiotype"><br><br>

                <strong>Transcript Biotype :</strong>
                <input type="text" placeholder="Enter the transcript biotype" name="transcriptbiotype"><br><br>

                <strong>Gene Symbol :</strong>
                <input type="text" placeholder="Enter the gene symbol" name="genesymbol"><br><br>

                <strong>Description :</strong>
                <input type="text" placeholder="Enter the description" name="description">

                <div class="button">
                    <input type="submit" value="Search"/><br> <!--submit the research-->
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
disconnect_db(); //deconnexion from the database
?>



