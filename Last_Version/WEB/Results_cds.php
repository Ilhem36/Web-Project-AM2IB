<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>
    <head>
    <meta charset="utf-8" />
        <title> Results cds and peptides </title>
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

<!--Résultats pour le formulaire CDS et peptides-->
<div class ="container">
    <div class="title"> Gene & protein Results </div><br>
    <table>
        <?php $str=$_SERVER['REQUEST_URI'];
        $keywords = preg_split("/=/", $str);
        $id = $keywords[1]; // Récupère l'id à partir du fichier search_cds grâce au lien
        ?>

        <?php
        $res = pg_query($db_conn,"SELECT * FROM w_gene.sequence, w_gene.annotation WHERE sequence.idsequence = annotation.idsequence AND sequence.idsequence='".$id."';");
        if (!$res) {
                echo "Une erreur s'est produite.\n";
            exit;
        }

        while ($row = pg_fetch_assoc($res) ){
            echo "<tr><th> Sequence ID : </th><td>".$row['idsequence']."</td></tr>
		          <tr><th> Accession Number (Genome) : </th><td><a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a></td></tr>
	              <tr><th> DNA type : </th><td>".$row['dna_type']."</td></tr>
		          <tr><th> CDS start position : </th><td>".$row['cds_start']."</td></tr>
		          <tr><th> CDS end position : </th><td>".$row['cds_end']."</td></tr>
		          <tr><th> Strand : </th><td>".$row['strand']."</td></tr>
		          <tr><th> CDS length : </th><td>".$row['cds_size']."</td></tr>
	              <tr><th> Peptide size : </th><td>".$row['pep_size']."</td></tr>
	              <tr><th> Gene ID : </th><td>".$row['geneid']."</td></tr>
	              <tr><th> Gene Biotype : </th><td>".$row['genebiotype']."</td></tr>
	              <tr><th> Transcript Biotype : </th><td>".$row['transcriptbiotype']."</td></tr>
	              <tr><th> Gene Symbol : </th><td>".$row['genesymbol']."</td></tr>
	              <tr><th> Description : </th><td>".$row['description']."</td></tr>";
            $cds_seq=$row['cds_seq'];
            $pep_seq = $row['pep_seq'];
        }
        ?>
    </table>

    <br>
    <strong>CDS Sequence : </strong>
    <textarea name="text" cols="55" rows="10" id="text">
        <?php echo $cds_seq; ?>
    </textarea>
    <br>
    <br>
    <strong>Protein Sequence : </strong>
    <textarea name="text" cols="55" rows="10" id="text">
        <?php echo $pep_seq; ?>
    </textarea>

    <!--TODO : fonctionnalités télécharger les résultats + css bouton qui n'est pas un form-->
    <div class="button">
        <input type="submit" name="ddl_results" value="Download results"><br>
    </div>
</div>

</body>
</html>
<?php
disconnect_db();
?>

