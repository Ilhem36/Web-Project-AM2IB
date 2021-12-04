<!DOCTYPE html>
<?php require_once 'db_utils.php';
# connexion à la base : affiche "connection failed" si pas de connection
    connect_db();
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="signin.css">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="container">
            <div class="title"> Genome full results : </div><br>
            <table>
             <!--Afficher les informations concernant le génome depuis la base de données -->

            <?php $str=$_SERVER['REQUEST_URI'];
                $keywords = preg_split("/=/", $str);
                $id = $keywords[1]; // id recupéré de l'url

                $query = pg_query($db_conn, "SELECT * FROM w_gene.genome WHERE accessionnb='".$id."';") or die("Error " . pg_last_error());

                while ($row = pg_fetch_assoc($query) ) {
                    echo " <tr><th> Accession Number : </th><td>" . $row['accessionnb'] . "</td></tr><br>
	                       <tr><th> Species : </th><td>" . $row['species'] . "</td></tr><br>
	                       <tr><th> Strain : </th><td>" . $row['strain'] . "</td></tr><br>
	                       <tr><th> Sequence length : </th><td>" . $row['seq_length'] . "</td></tr><br>";

                    $seq = $row['seq_nt'];
                }
                disconnect_db();
            ?>
            </table>

            <br>
            <!--affiche la séquence textuellement dans un cadre-->
            <p> Séquence : </p>
            <br>
            <textarea name="txt" cols="65" rows="20" id="txt1">
                <?php echo $seq; ?>
	        </textarea>

        </div>
    </body>
</html>
