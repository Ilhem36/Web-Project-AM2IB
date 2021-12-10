<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<title> Results Genome </title>
	<link rel="stylesheet" type="text/css" href="reader2.css">
</head>

<body>
<!-- Navigation Menu -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <?php require_once 'Menu.php' ; ?>

            <br><br>
            <div class = "hello">
                <?php
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
            //Initialization of $a & $b 
			$a = 0;
			$b = 5000;
			//Get the result for the right accession number
			$accessionnb = htmlspecialchars($_GET["id"]);

			//Set the values for $a and $b from the form
			if (isset($_GET["start"])) {
				$a = htmlspecialchars($_GET["start"]);
			}
			if (isset($_GET["end"])) {
				$b = htmlspecialchars($_GET["end"]);
			}
			
			?>

				<?php
                // Get and show the genome information from the accession number
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
			    //get the information for each cds sequence
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
				$annot =array_column($res2table, 'annot');
				?>
		</table>

		<br>
        <strong>Genome Sequence visualisation : </strong><br>
        Please put the start position and the end position of the sequence you want to visualise
        <br><br>

        <!-- form for $a & $b -->
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
                    //Represent the genome
					$partial_genome = substr($genome, $a, $b - $a);
					//We check that the input values are correct
					if($a < 0 or $a >= $b or $b > strlen($genome)){
						echo 'Invalid values';
                    }
                    else
                    {
                        echo $partial_genome;
						$char_width = 10;
                        $space = 34;
                        //Represent an indicator of the nucleotide position
                        for ($k = $a; $k <= $b; $k = $k + 10) {
                            $style = 'style="left:' . $k - $a . 'ch "';
                            echo '<div class="labely"  ' . $style . '><div class="labeltext">';
                            echo $k;
                            echo '</div></div>';
                            echo '<div class="label-bar" ' . $style . '></div>';
                        }
                        $Niv = array_fill(0, 99, 0);


                        //for each cds, the position is shown above the genome
                        //because of the overlap, we represent the cds at different distances of the genome
                        //This is done by assigning a "level" of distance to each cds : 
                        //for each cds, if there is no cds already plotted at a specific nucleotidic position, it is plot just above the genome.
                        //if a cds is already plotted, we then look at the next distace level, and so on
                        for ($i = 0; $i < count($sequence); $i++) {
                            $j = 0;
                            while ($debutsequence[$i] < $Niv[$j]) :
                                $j++;
                            endwhile;
                            $Niv[$j] = $finsequence[$i];
							
                            //If a cds is annotated, a link to its result page is created
							if($annot!=0){
								echo '<a href="Results_cds.php?id=' . $idsequence[$i] . '" class="bouton-seq-container" style="top: ' . (($j) * $space + 20) . 'px; left: ' . $debutsequence[$i] - $a . 'ch; width: ' . $longsequence[$i] . 'ch">';
								echo $idsequence[$i]; 
								echo '</a>';
							}
							//If a cds is not annotated, only its ID is shown
							else{
								echo '<input type="button" value="' . $idsequence[$i] . '" class="bouton-seq-container" style="top: ' . (($j) * $space + 20) . 'px; left: ' . $debutsequence[$i]-$a . 'ch; width: ' . $longsequence[$i] . 'ch">';
								echo '</input>';
							}
						};
                    }
					?>


				</div>
			</div>
		</div>

        <br>
        <button class='btn btn--assign' type="submit" name="ddl_results"> Download results</button><br>
	</div>
</body>

</html>

<?php
disconnect_db();
?>