<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
           Gène Prot
        </title>
        <!--link for css file -->
        <link rel="stylesheet" type="text/css" href="signin.css">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
    </head>
    <body>
    <div class="container">
        <div class="title"> Information about the selected gene & protein : </div>
        <!--Afficher, pour chaque option remplie dans le formulaire page Gene/protéine, le resultat-->  
        <!-- <a href="Formulaire_Gene_Prot.html" Lien vers la page formulaire Gene/protéine--->

        <!-- La fonction $_GET permet de récupérer les résultats des entrées dans les cases du formulaire--> 

        <!-- Exemple sur le fichier Escherichia_coli_cft073.cds.fa-->
            <div class = "input-box"> 
                <span class="details"> Accession number : <!--php echo $_GET["NumAccession"];--> AAN78501 </span>
            </div><br> 

            <div class = "input-box"> 
                <span class="details"> Gene sequence : <!--php echo $_GET["SeqGene"]; --> ATGC..</span>
            </div><br>

            <div class = "input-box"> 
                <span class="details"> Peptidic sequence : <!--php echo $_GET["SeqProt"]; --> MACM..</span>
            </div><br>

            <div class = "input-box"> 
                <span class="details"> Chromosome position : <!--php echo $_GET["ChromosomePosition"]; --> 190:255 </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Number of chromosome : <!--php echo $_GET["NbChrPosition"]; --> 1 </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">ID Gene : <!--php echo $_GET["IDGene"]; --> c5491 </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Gene biotype : <!--php echo $_GET["GeneBiotype"]; --> protein_coding </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Transcript biotype : <!--php echo $_GET["TranscriptBiotype"]; --> protein_coding </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Gene symbol : <!--php echo $_GET["GeneSymbol"]; --> thrL </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Description : <!--php echo $_GET["Description"]; --> Thr operon leader peptide </span>
            </div><br>
        
            <div class = "input-box"> 
                <span class="details">Genome associé : <!--php echo $_GET["NomGenome"];--> ASM744v1 <!-- du gène sur lequel on a cliqué sur la page genome --> </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Annotator email : <!--php echo $_GET["NomGenome"];--> abcd@yahoo.fr </span>
            </div><br>
                
            <div class = "input-box"> 
                <span class="details">Annotation status : <!--php echo $_GET["EtatAnnot"];-->  annoté </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Annotation Comments : <!--php echo $_GET["Commentaires"];--> annoté le 21/10/21 </span>
            </div><br>

    </div>
    </body>
</html>