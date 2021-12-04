<!DOCTYPE html>
<?php require_once 'db_utils.php';
# connexion à la base : affiche "connection failed" si pas de connection
connect_db();
?>
<html lang="fr">

  <head>
  	<meta charset="utf-8" />
  	<title>Page recherche</title>
		<link rel="stylesheet" type="text/css" href="signin.css">
  </head>

  <body>

<table style='width:40%';>
	<div id="pageresults">
	<h2> Résultats :</h2>
<?php

	$query_sql = "";
	$info_formulaire = ["accessionnb","species","strain","seq_length", "seq_nt"];
	$col_table = ["accessionnb","species","strain","seq_length","seq_nt"];
	for ($i = 0; $i <= 4; $i++) {
		$ch = $info_formulaire[$i];
		$col = $col_table[$i];
		if (!empty($_GET[$ch])){
			if (strlen($query_sql) > 5){
				if($ch != "seq_nt"){
					$query_sql .= "AND ".$col."='".$_GET[$ch]."'";
				}else{
					$query_sql .= "AND ".$col." LIKE '%".$_GET[$ch]."%' ";
				}
				
			}else{
				if($ch != "seq_nt"){
					$query_sql .= "SELECT * FROM w_gene.genome WHERE ".$col."='".$_GET[$ch]."'";
				}else{
					$query_sql .= "SELECT * FROM w_gene.genome WHERE ".$col." LIKE '%".$_GET[$ch]."%' ";
					
				}
				
			}
		}
	}
	if(strlen($query_sql) > 5){
		$query_sql .= ";";
		$res = pg_query($db_conn,$query_sql);
	}
	
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	if(pg_num_rows($res) == 0) {
		$res2 = pg_query($db_conn,"SELECT * FROM w_gene.genome;");
		echo " <div style='font-size:150%'> Aucun résultat </div> <br> <br> <br>";
		echo " <td colspan='5'> Accessionnb Species Genre Strain Sequence_length </td>";
		while ($row = pg_fetch_assoc($res2) ){
		echo "<div style='font-size:110%'> 
		<br><tr>
            	<td> <a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a></td> 
	    	<td>".$row['species']."</td>
	    	<td>".$row['strain']."</td>
	    	<td>".$row['seq_length']."</td>
       		</tr> </div>";
		
		}
	}
	
	if(pg_num_rows($res) != 0) {
		$array_id = array();
		echo " <td colspan='4'> Accessionnb Species Strain Sequence_length </td>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<br><tr>
            	<td> <a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a> </td>  
	    	<td>".$row['species']."</td>
	    	<td>".$row['strain']."</td>
	    	<td>".$row['seq_length']."</td>
       		</tr>";
		$array_id[] = $row['accessionnb'];
		
		}

	}

disconnect_db();
?>



</table>
</div>

</body>

</html>
