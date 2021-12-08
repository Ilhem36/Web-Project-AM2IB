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
	<div class='resultat'>
		<h2>Fiche</h2>
		<table style='width:10%' ;>
			<form action="Results_genome.php" method="post">
				<div class="genelim">
					<span class="details">Start</span>
					<input type="text" name="Start" placeholder="Start" required>
				</div>
				<div class="genelim">
					<span class="details">End</span>
					<input type="text" name="End" placeholder="End" required>
				</div>
				<div class="button">
					<input type="submit" name="submit" value="submit">
				</div>

				<?php
				if (isset($_POST['submit'])) {
					$a = $_POST['Start'];
					$b = $_POST['End'];
					header('Results_genome.php');
				}

				$str = $_SERVER['REQUEST_URI'];
				$keywords = preg_split("/=/", $str);
				$accessionnb = $keywords[1]; // id recupéré de l'url
				?>
				<?php

				#stocakge du genome
				$res1 = pg_query($db_conn, "SELECT * FROM w_gene.genome WHERE accessionnb='ASM666v1';");
				if (!$res1) {
					echo "Une erreur s'est produite.\n";
					exit;
				}
				echo " <td colspan='2'> Informations générales </td>";
				while ($row1 = pg_fetch_assoc($res1)) {
					echo "<div style='font-size:110%'> 
	<tr><th> Accession Number </th><td>" . $row1['accessionnb'] . "</td></tr><br>
	<tr><th> Species </th><td>" . $row1['species'] . "</td></tr><br>
	<tr><th> Strain </th><td>" . $row1['strain'] . "</td></tr><br>
	<tr><th> Sequence length </th><td>" . $row1['seq_length'] . "</td></tr><br>
        </div>";
					$genome = $row1['seq_nt'];
				}

				#stockage variables sequence
				$query = "SELECT * FROM w_gene.sequence WHERE accessionnb='ASM666v1' AND cds_end >= " . $a . " AND cds_start <= " . ($b) . ";";
				print_r($query);
				$res2 = pg_query($db_conn, $query);
				if (!$res2) {
					echo "Une erreur s'est produite.\n";
					exit;
				}
				$res2table = pg_fetch_all($res2);
				array_multisort($debutsequence = array_column($res2table, 'cds_start'), SORT_ASC, $res2table);
				$sequence = array_column($res2table, 'cds_seq');
				$debutsequence = array_column($res2table, 'cds_start');
				$finsequence = array_column($res2table, 'cds_end');
				$longsequence = array_column($res2table, 'cds_size');
				$idsequence = array_column($res2table, 'idsequence');

				?>
		</table>
		<h4>Séquence : </h4>
		<div class="card-container">
			<div class="card">
				<div class="genome">
					<?php
					$partial_genome = substr($genome, $a, $b-$a);
					echo $partial_genome;
					?>

					<?php
					$char_width = 10;
					$space = 34;
					for ($k = $a; $k <= $b; $k = $k + 10) {
						$style = 'style="left:' . $k-$a . 'ch "';
						echo '<div class="labely"  ' . $style . '><div class="labeltext">';
						echo $k;
						echo '</div></div>';
						echo '<div class="label-bar" ' . $style . '></div>';
						// echo "prout";
					}
					$Niv = array_fill(0, 99, 0);
					// print_r($seqpage);

					for ($i = 0; $i < count($sequence); $i++) {
						$j = 0;
						while ($debutsequence[$i] < $Niv[$j]) :
							// TODO incrémenter .append niv si $j > len($niv)
							$j++;
						endwhile;
						$Niv[$j] = $finsequence[$i];
						echo '<input type="button" value="' . $idsequence[$i] . '" class="bouton-seq-container" style="top: ' . (($j) * $space + 20) . 'px; left: ' . $debutsequence[$i]-$a . 'ch; width: ' . $longsequence[$i] . 'ch">';
						// echo "<input type='button' class='button-seq' value='".$idsequence[$i]."' />";
						echo '</input>';
					};
					?>


				</div>
				<!--Afficher sequence gene en couleu, en cliquant sur un gène, redirige vers la page gène associée -->
			</div>
		</div>
	</div>
	</textarea>

	</div>

</html>