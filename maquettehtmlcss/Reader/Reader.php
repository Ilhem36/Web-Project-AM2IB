<!DOCTYPE html>
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
                <span class="details">Ouputs type :</span>
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
                <input type="text" name = "Species" placeholder="Enter the Species" required>
            </div><br>
            <div class = "input-box">
                <span class="details">Strain : </span>
                <input type="text" name = "Strain" placeholder="Enter the strain" required>
            </div><br>
            <div class = "input-box">
                <span class="details">Sequence length : </span>
                <input type="text" name = "Seq_length" placeholder="Enter the Sequence length" required>
            </div><br>
<!--            <div class = "input-box">-->
<!--                <span class="details">Sequence : </span>-->
<!--                <input type="text" name = "Seq_nt" placeholder="Enter the Sequence" required>-->
<!--            </div><br>-->
            <div class="button">
                <input type="submit" name="search_genome" value="search_genome">
            </div><br>
    <?php endif;

            $servername ="localhost";
            $username = "lorraine";
            $password="2406";
            $dbname="lorraine";

            try{ //try, catch pour vérifier que la connexion à postgresql est établie ou non
                $conn = new PDO("pgsql: host=$servername; dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Fixe la base de données de travail
                $conn->exec('SET search_path TO web_gene');
                //echo "la connexion a été bien etablie"; //essaye de se connecter à la base de données. Si elle fonctionne -> affiche ce message
                echo "<br />";

                if(isset($_GET['search_genome'])) {
                    $accessionnb = $_GET['accessionnb']; //et si c'est null ?
                    $species = $_GET['species'];
                    $strain = $_GET['strain'];
                    $seq_length = $_GET['seq_length'];

                    //affichage des séquences génomiques à voir plus tard
                    //$seq_nt = $_GET['seq_nt'];
                    //or seq_nt = ?
                    //or !empty($_GET['seq_nt'])
                    //$seq_nt
                    //valeurs à remplir dans le formulaire génome = ASM744v1, NULL, NULL, 5231428

                    if(!empty($_GET['accessionnb']) or !empty($_GET['species']) or !empty($_GET['strain']) or !empty($_GET['seq_length'])) {
                        $sql =  "SELECT * FROM genome WHERE accessionnb = ? or species = ? or strain = ? or seq_length = ?  ";
                        $query = $conn -> prepare($sql);

                        $query -> execute([$accessionnb, $species, $strain, $seq_length]);
                    }
                }
            }


            catch(PDOException $e){ //sinon utilise PDOException pour renvoyer un message d'erreur
                echo "la connexion a échoué:" . $e-> getMessage();
            }
    ?>
            <?php if(isset($_GET['search_genome'])) :?>
            <div class="table-container">
                <div class="title"> Queries results : </div>
                <br>
                <table border="1">
                    <thead>
                    <tr>
                        <th> Accession number </th>
                        <th> Species</th>
                        <th> Strain </th>
                        <th> Sequence length </th>
<!--                        <th> Sequence </th> avec genome visualisation-->
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <?php while ($row = $query->fetch()) :?>
                        <td><?php echo $row['accessionnb'];?></td>
                        <td><?php echo $row['species'];?></td>
                        <td><?php echo $row['strain'];?></td>
                        <td><?php echo $row['seq_length'];?></td>
<!--                        <td>--><?php //echo $row['seq_nt'];?><!--</td>-->
                        <?php endwhile; ?>
                    </tr>
                    </tbody>
                </table><br>
            </div>
            <?php endif; ?>
            <!--<a href="GeneProt.html">Gene Protein Form Results</a> Le renvoi de la page vers la page results sera ensuite codé en php-->

    </form>
</div>

</body>

