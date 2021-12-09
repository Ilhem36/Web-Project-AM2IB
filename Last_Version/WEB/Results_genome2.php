<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>

<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<title> Results Genome </title>
	<link rel="stylesheet" type="text/css" href="reader2.css">
</head>

<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="annot_in_progress.php">Annotations</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a>
            <li><a href="signIn.php">Logout</a><br><br>
                <div class = "hello">
                    <?php require_once 'db_utils.php';
                    connect_db();
                    session_start();
                    echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                    ?>
                </div>
        </ul>
    </div>
</nav>

	<div class="container">
		<div class="title"> Genome Results </div><br>
		<table>
			<?php
			$a = 0;
			$b = 5000;
			// $str = $_SERVER['REQUEST_URI'];
			// $keywords = preg_split("/=/", $str);
			$accessionnb = htmlspecialchars($_GET["id"]);

			// $a = htmlspecialchars($_GET["start"]);
			// $b = htmlspecialchars($_GET["end"]);

			if (isset($_GET["start"])) {
				$a = htmlspecialchars($_GET["start"]);
			}
			if (isset($_GET["end"])) {
				$b = htmlspecialchars($_GET["end"]);
			}
			
			?>

				<?php
				// if (isset($_POST['submit'])) {
				// 	$a = $_POST['Start'];
				// 	$b = $_POST['End'];
				// }


				$result = pg_query($db_conn, "SELECT * FROM w_gene.genome WHERE accessionnb='" . $accessionnb . "';");
				// echo $accessionnb;
				if (!$result) {
					echo "An error has occurred.\n";
					exit;
				}
				while ($row = pg_fetch_assoc($result)) {
					echo "<tr><th> Accession Number : </th><td> " . $row['accessionnb'] . "</td></tr>
	              <tr><th> Species : </th><td> " . $row['species'] . "</td></tr>
	              <tr><th> Strain : </th><td> " . $row['strain'] . "</td></tr>
	              <tr><th> Sequence length : </th><td> " . $row['seq_length'] . "</td></tr>";
					$genome = $row['seq_nt'];
				}
				#stockage variables sequence
				$query = "SELECT * FROM w_gene.sequence WHERE accessionnb='" . $accessionnb . "' AND cds_end >= '" . $a . "' AND cds_start <= '" . $b . "';";
				$res2 = pg_query($db_conn, $query);
				if (!$res2) {
					echo "An error has occurred.\n";
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

		<br>
        <strong>Genome Sequence visualisation : </strong><br>
        Please put the start position and the end position of the sequence you want to visualise
        <br><br>

        <form method="get" action="Results_genome2.php">
            <div class="genelim">
                <span class="details"><strong>Start</strong></span>
                <input type="text" name="start" value="<?php echo $a; ?>" placeholder="Start" required>
            </div>
            <div class="genelim">
                <span class="details"><strong>End </strong></span>
                <input type="text" name="end" value="<?php echo $b; ?>" placeholder="End" required>
                <input type="text" name="id" style="display: none" required value="<?php echo htmlspecialchars($_GET["id"]); ?>"/>
            </div>
            <div class="button-visualisation">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
        <br>

		<div class="card-container">
			<div class="card">
				<div class="genome">
					<?php
					$partial_genome = substr($genome, $a, $b - $a);
					echo $partial_genome;
					echo $accessionnb;
					?>

					<?php
					$char_width = 10;
					$space = 34;
					for ($k = $a; $k <= $b; $k = $k + 10) {
						$style = 'style="left:' . $k - $a . 'ch "';
						echo '<div class="labely"  ' . $style . '><div class="labeltext">';
						echo $k;
						echo '</div></div>';
						echo '<div class="label-bar" ' . $style . '></div>';
					}
					$Niv = array_fill(0, 99, 0);

					for ($i = 0; $i < count($sequence); $i++) {
						$j = 0;
						while ($debutsequence[$i] < $Niv[$j]) :
							// TODO incrémenter .append niv si $j > len($niv)
							$j++;
						endwhile;
						$Niv[$j] = $finsequence[$i];

						// href='Results_cds.php?id=".$row['idsequence']."'
						echo '<a href="Results_cds.php?id=' . $idsequence[$i] . '" class="bouton-seq-container" style="top: ' . (($j) * $space + 20) . 'px; left: ' . $debutsequence[$i] - $a . 'ch; width: ' . $longsequence[$i] . 'ch">';
						echo $idsequence[$i]; // echo "<input type='button' class='button-seq' value='".$idsequence[$i]."' />";
						echo '</a>';
					};
					?>


				</div>
				<!--Afficher sequence gene en couleur, en cliquant sur un gène, redirige vers la page gène associée -->
			</div>
		</div>

        <br>
		<!--TODO : fonctionnalités télécharger les résultats -->
        <button class='btn btn--assign' type="submit" name="ddl_results"> Download results</button><br>
	</div>
</body>

</html>

<?php
disconnect_db();
?>