<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>

<head>

    <meta charset="utf-8" />
    <title> Search cds and peptides </title>
    <link rel="stylesheet" type="text/css" href="signin.css">

</head>
<body>


<!-- Formulaire pour CDS et peptides -->
<!-- Tables sequence + annotation-->
<div id ="searchSeqGenome2">
    <form action="Search_cds.php" method="get">
        <h3> Form cds & pep </h3>

        <!--TODO: rajouter des options à choisir avec menus déroulants-->
        <!--Info provenant de la table sequence-->
        ID sequence :
        <input type="text" placeholder="idsequence" name="idsequence">

        AccessionNb :
        <input type="text" placeholder="accessionnb" name="accessionnb"><br><br>

        DNA_type :
        <input type="text" placeholder="dna_type" name="dna_type">

        CDS_start :
        <input type="text" placeholder="cds_start" name="cds_start"><br><br>

        CDS_end :
        <input type="text" placeholder="cds_end" name="cds_end">

        Strand :
        <input type="text" placeholder="strand" name="strand"><br><br>

        CDS_seq : <br>
        <textarea id="txtArea" rows="3" cols="60" name="cds_seq" placeholder = "cds_seq"></textarea> <br><br>

        CDS_size :
        <input type="text" placeholder="cds_size" name="cds_size"><br><br>

        Pep_seq: <br>
        <textarea id="txtArea" rows="3" cols="60" name="pep_seq" placeholder = "pep_seq"></textarea><br><br>

        Pep_size :
        <input type="text" placeholder="pep_size" name="pep_size">

        <!--Info provenant de la table annotation-->
        GeneID :
        <input type="text" placeholder="geneid" name="geneid"><br><br>

        GeneBiotype :
        <input type="text" placeholder="genebiotype" name="genebiotype">

        TranscriptBiotype :
        <input type="text" placeholder="transcriptbiotype" name="transcriptbiotype"><br><br>

        GeneSymbol :
        <input type="text" placeholder="genesymbol" name="genesymbol">

        Description :
        <input type="text" placeholder="description" name="description"><br><br>

        <input type="submit" value="Rechercher"/></button> <br>

    </form>
</div>

</body>


</html>




