<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>
  <head>
  <meta charset="utf-8" />
        <title> Results pages</title>
	 <link rel="stylesheet" type="text/css" href="reader.css">
  </head>

 <body>
 <!-- Menu de navigation -->
 <nav>
     <div class="nav-content">
         <div class="logo">
             <a href="#">GenAnnot.</a>
         </div>
         <ul class="nav-links">
             <li><a href="Home_page.php">Home</a></li>
             <li><a href="#">Admin</a></li>
             <li><a href="#">Validator</a></li>
             <li><a href="#">Annotator</a></li>
             <li><a href="#">Reader</a>
                 <ul class="sous-menu">
                     <li class = "sous-menu1"><a href="#">Form</a></li>
                     <ul class="sous-sous-menu">
                         <li class="sous-menu2"><a href="Form_genome.php">Genomes Form</a></li>
                         <li class="sous-menu2"><a href="Form_cds.php">Genes/Prot Form</a></li>
                         <!--TODO: sous menu apparait quand tu passes ta souris-->
                     </ul>
                 </ul>
             </li>
             <li><a href="#">Logout</a>
                 <!--signIn.php-->
         </ul>
     </div>
 </nav>

 <div class ="container">
     <div class="title"> Genome Results </div><br>
        <table>
        <form method="post" action= "Results_genome.php">
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
	    $str=$_SERVER['REQUEST_URI'];
	    $keywords = preg_split("/=/", $str);
	    $accessionnb= $keywords[1];
		echo $a;

        if (isset($_POST['submit'])) {
            $a = $_POST['Start'];
            $b = $_POST['End'];
			header('Results_genome.php');
        }
	    

        $result = pg_query($db_conn,"SELECT * FROM w_gene.genome WHERE accessionnb='ASM584v2';");
	    if (!$result) {
 		    echo "Une erreur s'est produite.\n";
  	    exit;
	    }

        while ($row = pg_fetch_assoc($result)){
	        echo "<tr><th> Accession Number : </th><td> ".$row['accessionnb']."</td></tr>
	              <tr><th> Species : </th><td> ".$row['species']."</td></tr>
	              <tr><th> Strain : </th><td> ".$row['strain']."</td></tr>
	              <tr><th> Sequence length : </th><td> ".$row['seq_length']."</td></tr>";
                  $genome = $row['seq_nt'];
	    }
        #stockage variables sequence
				$query = "SELECT * FROM w_gene.sequence WHERE accessionnb='ASM584v2' AND cds_end >= " . $a . " AND cds_start <= " . ($b) . ";";
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

        <br><br>

        <strong>Genome Sequence : </strong>
        <div class="card-container">
			<div class="card">
				<div class="genome">
					<?php
					$partial_genome = substr($genome, $a, $b-$a);
					echo $partial_genome;
					echo $accessionnb;
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
					}
					$Niv = array_fill(0, 99, 0);

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

     <!--TODO : fonctionnalités télécharger les résultats + css bouton qui n'est pas un form-->
     <div class="button">
         <input type="submit" name="ddl_results" value="Download results"><br>
     </div>

</div>
 </body>
</html>

<?php
disconnect_db();
?>


