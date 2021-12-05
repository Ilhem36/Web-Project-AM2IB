<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>
<head>
    <meta charset="utf-8" />
        <title> CDS and Peptides Search Form </title>
    <link rel="stylesheet" type="text/css" href="reader.css">
</head>
<body>

<!-- Menu de navigation -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
            <li><a href="#">Reader</a>
                <ul class="sous-menu">
                    <li class = "sous-menu1"><a href="#">Form</a></li>
                    <ul class="sous-sous-menu">
                        <li class="sous-menu2"><a href="Form_genome.php">Genomes Form</a></li>
                        <li class="sous-menu2"><a href="Form_cds.php">Genes/Prot Form</a></li>
                        <!--TODO: sous menu apparait quand tu passes ta souris-->
                    </ul>
                </ul>
            </li>
            <li><a href="#">Logout</a>
                <!--signIn.php-->
        </ul>
    </div>
</nav>

<!-- Formulaire pour CDS et peptides -->
<!-- Tables sequence + annotation-->

<div class ="container">
    <div class="title"> Search information about Genes & Peptides </div><br>
    <form action="Search_cds.php" method="post">
        <div class="form-details">
            <div class = "input-box">

        <!--Info provenant de la table sequence-->
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

                <!--Info provenant de la table annotation-->
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
                    <input type="submit" value="Search"/><br>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>




