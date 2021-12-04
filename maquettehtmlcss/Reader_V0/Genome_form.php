<!DOCTYPE html>
<?php require_once 'db_utils.php';
    connect_db();
?>

<!--reader page = choisi output -> type de sorties-->
<!--page accueil -> if email -> rôle = lecteur+annotateur+validateur. Affiche cette page :-->
<!--les info sur les fichiers fasta déjà 'annotated and validated'-->

<head>
    <meta charset="utf-8">
    <title>Reader Page</title>
    <link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>

<div class="container">
    <div class="title"> Choose your outputs type:  </div>
    <br>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" >
            <div class = "input-box">
                <span class="details">Outputs type :</span>
                <select name="Outputs">
                    <option value= "Genomes">Genomes</option>
                    <option value= "Genes">Genes/CDS</option>
                    <option value= "Genes">Proteins/Peptides</option>
                </select> <br>
            </div>
        <br>
        <div class="button">
            <input type="submit" name="submit" value="submit type">
        </div><br>

    <?php if (isset($_GET['submit'])&&(!empty($_GET['Outputs']=='Genomes'))) :?>
    <div class="container">
        <div class="title"> Fill out this Form: </div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" >
        <td class= "Request form">
            <br>
            <!--Genome-->
            <div class = "input-box">
                <span class="details">Accession Number : </span>
                <input type="text" name="accessionnb" placeholder="Enter the Accession Number" required>
            </div><br>
            <div class = "input-box">
                <span class="details">Species : </span>
                <input type="text" name = "Species" placeholder="Enter the Species">
            </div><br>
            <div class = "input-box">
                <span class="details">Strain : </span>
                <input type="text" name = "Strain" placeholder="Enter the strain">
            </div><br>
            <div class = "input-box">
                <span class="details">Sequence length : </span>
                <input type="text" name = "Seq_length" placeholder="Enter the Sequence length">
            </div><br>
            <div class = "input-box">
                <span class="details">Sequence : </span>
                <input type="text" name = "Seq_nt" placeholder="Enter the Sequence">
            </div><br>
            <div class="button">
                <input type="submit" name="search_genome" value="search_genome">
            </div><br>
    <?php endif;
        disconnect_db();
    ?>
            
    </form>
</div>

</body>

