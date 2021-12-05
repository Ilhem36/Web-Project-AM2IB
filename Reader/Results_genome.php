<!DOCTYPE html>
<?php require_once 'db_utils.php';
# connexion à la base : affiche "connection failed" si pas de connection
connect_db();
?>
<html>

  <head>

  <meta charset="utf-8" />
        <title> Results pages</title>
	 <link rel="stylesheet" type="text/css" href="signin.css">
  </head>
 <body>

	<!-- Fiche Genome -->
	<div class = 'resultat'> 
	<h2>Fiche</h2>
<table style='width:10%';>

	<?php
    $str=$_SERVER['REQUEST_URI'];
	$keywords = preg_split("/=/", $str);
	$accessionnb= $keywords[1]; // id recupéré de l'url
	?>
	<?php

	$res1 = pg_query($db_conn,"SELECT * FROM w_gene.genome WHERE accessionnb='55';");
	if (!$res1) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	echo " <td colspan='2'> Informations générales </td>";
	while ($row1 = pg_fetch_assoc($res1) ){
	echo "<div style='font-size:110%'> 
	<tr><th> Accession Number </th><td>".$row1['accessionnb']."</td></tr><br>
	<tr><th> Species </th><td>".$row1['species']."</td></tr><br>
	<tr><th> Strain </th><td>".$row1['strain']."</td></tr><br>
	<tr><th> Sequence length </th><td>".$row1['seq_length']."</td></tr><br>
        </div>";
	$genome = $row1['seq_nt'];
	
	}

	$res2 = pg_query($db_conn,"SELECT * FROM w_gene.sequence WHERE accessionnb='55';");
	if (!$res2) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	$res2table= pg_fetch_all($res2);
	array_multisort( $debutsequence = array_column($res2table, 'cds_start'), SORT_ASC, $res2table);
	$sequence = array_column($res2table, 'cds_seq');
	$debutsequence = array_column($res2table, 'cds_start');
	$longsequence = array_column($res2table, 'cds_size');
	$idsequence = array_column($res2table, 'idsequence');
	
?>
</table>
        <h4>Séquence : </h4>
		<div class="card-container">
            <div class="card">
                <div class="chain-container">
                <?php
				for($i=0;$i<count($sequence);$i++)
				{
					// echo "<input type='button' value='".$idsequence[$i]."' />";
					$input = "<input type='button' class='button-id' value='".$idsequence[$i]."' />";
					// $input_length = strlen($input)
					$open_bk = "<div class='container-red'>";
					$close_bk = "</div>";
					$total_length = strlen($input) + 1 + strlen($open_bk) + 1 + strlen($close_bk) + 1;
					$genome = substr_replace($genome,"$open_bk $input $sequence[$i] $close_bk", $debutsequence[$i]+$total_length*$i,$longsequence[$i]);
				}
				echo $genome; 
				?>	
                 <!--Afficher sequence gene en couleu, en cliquant sur un gène, redirige vers la page gène associée -->
                </div>
             </div>
        </div>
	</textarea>

    </div>
</html>

