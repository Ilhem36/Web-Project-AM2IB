<?php
//When we click on a idsequence from the page search_cds -> it leads to this page
//This is the results page for each cds and associated proteins
require_once 'db_utils.php';
connect_db();//connexion to the database
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8" />
        <title> Results cds and peptides </title>
    <link rel="stylesheet" type="text/css" href="reader.css">
</head>

<body>
<nav>
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

<!--CDS and peptides form results-->
<div class ="container">
    <div class="title"> Gene & protein Results </div><br>
    <table>
        <?php $str=$_SERVER['REQUEST_URI']; //hold the full request path including the querystring. 
        $keywords = preg_split("/=/", $str); //breaks the equal symbol string
        $id = $keywords[1]; // Get the ID (= accession number) from the file search_cds.php thanks to the link between those two files
        ?>

        <?php
	//preparation of the sql query from table sequence and annotation
        $res = pg_query($db_conn,"SELECT * FROM w_gene.sequence, w_gene.annotation WHERE sequence.idsequence = annotation.idsequence AND sequence.idsequence='".$id."';");
        if (!$res) { //No results
                echo "An error has occurred.\n";
            exit;
        }

        while ($row = pg_fetch_assoc($res) ){ //Display the result
            echo "<tr><th> Sequence ID : </th><td>".$row['idsequence']."</td></tr>
		          <tr><th> Accession Number (Genome) : </th><td><a href='Results_genome2.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a></td></tr> //The accession number is clickable and leads to the genome results page 
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
	              <tr><th> Description : </th><td>".$row['description']."</td></tr>
	              ";
            $cds_seq=$row['cds_seq'];
            $pep_seq = $row['pep_seq'];
            $id_databank = $row['idsequence']; //to search gene results in existing external databank with the idsequence
        }
        ?>
    </table>

    <?php

    //Link to other databank =
    //NCBI (protein database) with the id sequence of the cds/pep
    $url_ncbi = "https://www.ncbi.nlm.nih.gov/protein/$id_databank";

    //Ensembl Bacteria
    $url_ensembl = "http://bacteria.ensembl.org/Multi/Search/Results?species=all;idx=;q={$id_databank};";
    $contents = file_get_contents($url_ensembl); //read the links
    $result = array(); //the result is an array
    $link = preg_match_all('#<a class="name" href="/(.+?)">#', $contents, $result); //puts values in contents and result in the href
    $url_ensembl = "http://bacteria.ensembl.org/{$result[1][0]}"; //the url of ensmbl is prepared with the correct idsequence

    //Uniprot
    $contents2 = file_get_contents($url_ensembl);//uniprot gets the idsequence from ensembl
    $result2 = array();
    $link2 = preg_match_all('#<a href="http://www.uniprot.org/uniprot/(.+?)"#', $contents2, $result2); 
    $url_uniprot = "http://www.uniprot.org/uniprot/{$result2[1][0]}";
    ?>

    <br>
    <!--display the cds sequence and protein sequence in two text areas-->
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

    <br><br>
	
    <!--Buttons lead to external databank links -->
    <strong>Need more information ? Links to other databank : </strong><br>
    <button class='btn btn--assign' onclick = "location.href = '<?php echo $url_ncbi;?>'"><br> NCBI </button> <br>
    <button class='btn btn--assign' onclick = "location.href = '<?php echo $url_ensembl;?>'"><br> Ensembl </button> <br>
    <button class='btn btn--assign' onclick = "location.href = '<?php echo $url_uniprot;?>'"><br> Uniprot </button> <br>
    <br>

    <!-- Blastn and Blastp alignments -->
        <strong>Blastn (genes) :</strong><br>
        <form action="blast_cds.php" method="get"> 
            <input type="hidden" name="gene_seq" value=<?php echo preg_replace('/\s+/','',$cds_seq);?>> <!--delete the whitespaces in the cds sequence before the blast query-->
            <input type="submit" class='btn btn--assign' value="BLASTn">
        </form> <br>

        <strong>Blastp (proteins) :</strong><br>
        <form action="blastprot.php" method="get">
            <input type="hidden" name="prot_seq" value=<?php echo preg_replace('/\s+/','',$pep_seq); ?>><!--delete the whitespaces in the peptide sequence before the blast query-->
            <input type="submit" class='btn btn--assign' value="BLASTp">
        </form> <br>

	<!--Download button-->  
    <button class='btn btn--assign' type="submit" name="ddl_results"> Download results</button><br>
</div>

</body>
</html>
<?php
disconnect_db();//deconnexion from the database
?>

