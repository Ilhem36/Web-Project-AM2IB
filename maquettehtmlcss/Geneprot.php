<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
           Gène Prot
        </title>
        <!--link for css file -->
        <link rel="stylesheet" type="text/css" href="style2.css">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="affichage">
        <!--Afficher, pour chaque option remplie dans le formulaire page Gene/protéine, le resultat-->  
        <!-- <a href="Formulaire_Gene_Prot.html" Lien vers la page formulaire Gene/protéine--->
        <!-- La fonction $_GET permet de récupérer les résultats des entrées dans les cases du formulaire--> 
        <!-- Exemple sur le fichier Escherichia_coli_cft073.cds.fa-->
            Numero Accession : <?php echo $_GET["NumAccession"]; ?> AAN78501 <br>
            Gene seq : <?php echo $_GET["SeqGene"]; ?> <br>
            Peptidic sequence : <?php echo $_GET["SeqProt"]; ?>  <br>
            Chromosome position : <?php echo $_GET["ChromosomePosition"]; ?> 190:255 <br>
            Number of chromosome : <?php echo $_GET["NbChrPosition"]; ?> 1 <br>
            ID Gene : <?php echo $_GET["IDGene"]; ?> c5491 <br>
            Gene biotype : <?php echo $_GET["GeneBiotype"]; ?> protein_coding <br>
            Transcript biotype : <?php echo $_GET["TranscriptBiotype"]; ?> protein_coding <br>
            Gene symbol : <?php echo $_GET["GeneSymbol"]; ?> thrL <br>
            Description : <?php echo $_GET["Description"]; ?> Thr operon leader peptide <br>
        
            Genome associé : <?php echo $_GET["NomGenome"];?> ASM744v1 <br> <!-- du gène sur lequel on a cliqué sur la page genome -->
            Annotator email : <?php echo $_GET["NomGenome"]; ?> abcd@yahoo.fr <br> 
            Annotation status : <?php echo $_GET["EtatAnnot"]; ?> annoté <br>
            Annotation Comments : <?php echo $_GET["Commentaires"]; ?> annoté le 21/10/21 <br>
        </div>
    </body>
</html>