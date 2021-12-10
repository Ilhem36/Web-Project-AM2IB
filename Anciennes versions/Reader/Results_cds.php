<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>

<head>

    <meta charset="utf-8" />
    <title> Results cds and peptides </title>
    <link rel="stylesheet" type="text/css" href="signin.css">

</head>
<body>

<!-- Fiche Transcrit -->
<div class = 'resultat'>
    <table style='width:10%';>
        <?php $str=$_SERVER['REQUEST_URI'];
        $keywords = preg_split("/=/", $str);
        $id = $keywords[1]; // id de la sequence d'interet, récupéré grace à l'URL
        ?>

        <h1> Results  </h1>
        <?php

        $res = pg_query($db_conn,"SELECT * FROM w_gene.sequence, w_gene.annotation WHERE sequence.idsequence = annotation.idsequence AND sequence.idsequence='".$id."';");

        if (!$res) {
            echo "Une erreur s'est produite.\n";
            exit;
        }

        while ($row = pg_fetch_assoc($res) ){
            echo "<td colspan='2'> Informations générales </td>
		<tr><th> Seq ID </th><td>".$row['idsequence']."</td></tr>
		<tr><th> Genome ID </th><td><a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a></td></tr>
	    <tr><th> DNA_type</th><td>".$row['dna_type']."</td></tr>
		<tr><th> CDS_start </th><td>".$row['cds_start']."</td></tr>
		<tr><th> CDS_end </th><td>".$row['cds_end']."</td></tr>
		<tr><th> Strand </th><td>".$row['strand']."</td></tr>
		<tr><th> CDS_size </th><td>".$row['cds_size']."</td></tr>
	    <tr><th> Pep_size </th><td>".$row['pep_size']."</td></tr>
	    <tr><th> Gene_Id </th><td>".$row['geneid']."</td></tr>
	    <tr><th> Gene_Biotype</th><td>".$row['genebiotype']."</td></tr>
	    <tr><th> Transcript_Biotype </th><td>".$row['transcriptbiotype']."</td></tr>
	    <tr><th> Gene_Symbol </th><td>".$row['genesymbol']."</td></tr>
	    <tr><th> Fonction </th><td>".$row['description']."</td></tr>";


            //$seqnuc=$row['seqnt'];
            //$seqaa = $row['seqprot'];
            //$transcrit=$row['nomgene'];
            //TODO: reste encore
        }
        ?>

    </table>

<!--    <h4>Séquence nucléotidique: </h4>-->
<!--    <textarea name="txt" cols="65" rows="10" id="txt1">-->
<!--    php //echo $seqnuc;-->
<!--	</textarea>-->
<!---->
<!--    <h4>Séquence protéique: </h4>-->
<!--    <textarea name="txt" cols="65" rows="10" id="txt1">-->
<!--    php //echo $seqaa; -->
<!--	</textarea>-->


</div>

</div>
</body>
</html>

