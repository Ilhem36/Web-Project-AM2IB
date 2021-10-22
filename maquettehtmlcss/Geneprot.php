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
        <div class="title"> Information about the selected gene & protein : </div><br> 
        <!--Afficher, pour chaque option remplie dans le formulaire page Gene/protéine, le resultat-->  
        <!-- <a href="Formulaire_Gene_Prot.html" Lien vers la page formulaire Gene/protéine--->

        <!-- La fonction $_GET ou $_POST permet de récupérer les résultats des entrées dans les cases du formulaire--> 

        <!-- Exemple sur le fichier Escherichia_coli_cft073.cds.fa-->
            <div class = "input-box"> 
                <span class="details"> Accession number : <!--php echo $_GET["NumAccession"];--> AAN78501 </span>
            </div><br> 
            
            <div class = "input-box"> 
                Gene sequence : <!--php echo $_GET["SeqGene"]; -->
                <div class="card-container">
                    <div class="card">
                        <div class="chain-container">
                        ATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGCATGC
                        </div>
                    </div>
                </div>
            </div><br>

            <div class = "input-box"> 
                Peptidic sequence : <!--php echo $_GET["SeqProt"]; -->
                <div class="card-container">
                    <div class="card">
                        <div class="chain-container">
                        MTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILKMTILK
                        </div>
                    </div>
                </div>
            </div><br>

            <div class = "input-box"> 
                <span class="details"> Chromosome position : <!--php echo $_GET["ChromosomePosition"]; --> 190:255 </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Number of chromosome position : <!--php echo $_GET["NbChrPosition"]; --> 1 </span>
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
                <span class="details">Annotator email : <!--php echo $_GET["AnnotEmail"];--> abcd@yahoo.fr </span>
            </div><br>
                
            <div class = "input-box"> 
                <span class="details">Annotation status : <!--php echo $_GET["AnnotStatus"];--> annotated </span>
            </div><br>
            
            <div class = "input-box"> 
                <span class="details">Annotation Comments : <!--php echo $_GET["Comments"];--> </span>
            </div><br>

    </div>
    </body>
</html>

