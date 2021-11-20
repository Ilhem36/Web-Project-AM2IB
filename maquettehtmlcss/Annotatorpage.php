<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style type="text/css">
            *{
                margin:0;
                padding:0;
                box-sizing: border-box;
            }
            body{
                background-color:darkmagenta;
                font-family: sans-serif;
            }
            .table-container{
                padding: 0 10%;
                margin: 40px auto 0;
            }
            .heading{
                font: size 40px;
                text-align: center;
                color:white;
                margin-bottom: 40px;
            }
            .table{
                width: 100%;
                border-collapse: collapse;
            }
            .table thead {
                background-color: white;
            }
            .table thead tr th {
                font-size: 14px;
                font-weight: medium;
                letter-spacing: 0.35px;
                color: black;
                opacity: 1;
                padding: 12px;
                vertical-align: top;
                border: 1px solid black;
            }
            .table tbody tr td{
                font-size: 14px;
                letter-spacing: 0.35;
                font-weight: normal;
                color:black;
                background-color:white;
                padding: 8px;
                text-align: center;
                border: 1px solid black;

            }
            .table .text_open{
                font-size: 14px;
                font-weight: bold;
                letter-spacing: 0.35px;
                color: cornflowerblue;
            }
            .table .tbody tr td .btn{
                width: 130px;
                text-decoration: none;
                line-height: 35px;
                display: block;
                background-color: #FF1046 ;
            }
        </style>

    </head>
    <body>
    <?php
        //Connexion aux bases de données postgresql
        $servername ="localhost";
        $username = "postgres";
        $password="Think13";
        $dbname="gene";

        //try, catch pour vérifier que la connexion à postgresql est établie ou non
        try{
            $conn = new PDO("pgsql: host=$servername; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Fixe la base de données de travail
            $conn->exec('SET search_path TO gene');
            echo "la connexion a été bien etablie"; //essaye de se connecter à la base de données. Si elle fonctionne -> affiche ce message
            echo "<br />";

            //Retreive Data
            $email = $_REQUEST['email'];

            //Requêtes + affichage des résultats
            $sql = "SELECT annot.geneid,annot.idsequence,annot.genebiotype,annot.transcriptbiotype,annot.genesymbol,annot.description, gn.species, gn.strain, gn.accessionnb FROM gene.annotation AS annot,gene.genome AS gn, gene.sequence WHERE  annot.idsequence=sequence.idsequence and sequence.accessionnb = gn.accessionnb AND annot.email_annot = '{$email}';";
            try{
                $result = $conn->query($sql);

            }catch(PDOException $e){
                echo "update has failed ". $e->getMessage();
            }


        }

        catch(PDOException $e){ //sinon utilise PDOException pour renvoyer un message d'erreur
            echo "la connexion a échoué:" . $e-> getMessage();
        }
        ?>
        <div class="table-container">
        <h1 class="heading"> Annotation suggestions </h1>
        <table class="table">
            <thead>
            <tr>
                <th> Genome Name </th>
                <th> Species</th>
                <th> Strain </th>
                <th> Download complete genome </th>
                <th> Annotation ID </th> <!--pour savoir de quel cds on parle-->
                <th> Annotation status</th>
                <th> Description </th>
                <th>Genebiotype</th>
                <th>transcriptBiotype</th>
                <th> Redirection </th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $res) :  ?>
            <tr>
                <td id="accessionnb"><?php echo $res['accessionnb']; ?></td>
                <td id="Specie"><?php echo $res['species']; ?></td>
                <td id="Strain"><?php echo $res['strain']; ?></td>
                <td><input type="button" value="Download Genome 1"></td>
                <td id="seqid"><?php echo $res['idsequence']; ?></td>
                <td id="Annotation-status">annotated and validated</td>
                <td id="description"><?php echo $res['description']; ?></td>
                <td id="description"><?php echo $res['genebiotype']; ?></td>
                <td id="description"><?php echo $res['transcriptbiotype']; ?></td>

                <td><a href="GeneProt.html">Gene Protein Form Results</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table><br>
        <input type="button" value="Enter">

    </div>

        <form action="/WP/Web-Project-AM2IB-1/maquettehtmlcss/fill_annot.php" method="post">
            <label for="genebiotype">genebiotype</label><br>
            <input type="text" id="genebiotype" name="genebiotype" placeholder="enter genebiotype"><br>
            <label for="transciptbiotype">transciptbiotype:</label><br>
            <input type="text" id="transciptbiotype" name="transciptbiotype" placeholder="enter transciptbiotype"><br><br>
            <label for="genesymbol">genesymbol:</label><br>
            <input type="text" id="genesymbol" name="genesymbol" placeholder="enter genesymbol"><br><br>
            <label for="length">length:</label><br>
            <input type="text" id="length" name="length" placeholder="enter length"><br><br>
            <label for="description">description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" placeholder="enter description">
        </textarea><br><br>
            <input type="submit" value="Soumettre">
        </form>
    </body>


