<!DOCTYPE html>
<?php require_once 'db_utils.php';
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

    $result = pg_query($db_conn,"SELECT * FROM w_gene.genome WHERE accessionnb='".$accessionnb."';");
	if (!$result) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	echo " <td colspan='2'> Informations générales </td>";
	while ($row = pg_fetch_assoc($result) ){
	echo "<div style='font-size:110%'> 
	<tr><th> Accession Number </th><td>".$row['accessionnb']."</td></tr><br>
	<tr><th> Species </th><td>".$row['species']."</td></tr><br>
	<tr><th> Strain </th><td>".$row['strain']."</td></tr><br>
	<tr><th> Sequence length </th><td>".$row['seq_length']."</td></tr><br>
        </div>";
	$seq = $row['seq_nt'];
	}
?>
</table>
        <h4>Séquence : </h4>
        <textarea name="txt" cols="65" rows="20" id="txt1">
    <?php echo $seq; ?>
	</textarea>

    </div>
</html>

