<!DOCTYPE html>
<?php require_once 'db_utils.php';
    connect_db();
?>

<!--php if(isset($_GET['search_genome'])) :-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="signin.css">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head>

<body>
<div class="container">
    <div class="title"> Genome results list : </div>
    <br>

    <table border="1">
        <?php
        //liste tous les génomes contenus dans la base, mais sans l'affichage des séquences
        $sql = "SELECT * FROM w_gene.genome";
        $query = pg_query($db_conn, $sql) or die("Error " . pg_last_error());
        echo " <td> Accession Number </td>
               <td> Species </td>
               <td> Strain </td>
               <td> Sequence length </td>"; //besoin d'un outil de visualisation des séquences

        while ($row = pg_fetch_assoc($query)) {
            echo "<tr>
            	<td> <a href='Genome_results.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a> </td> 
	    	    <td>" . $row['species'] . "</td>
	    	    <td>" . $row['strain'] . "</td>
		        <td>" . $row['seq_length'] . "</td>
       		    </tr>";
        }
        disconnect_db();
        ?>
    </table>
</div>
</body>
</html>