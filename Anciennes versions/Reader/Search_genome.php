<!DOCTYPE html>
<?php require_once 'db_utils.php';
# connexion à la base : affiche "connection failed" si pas de connection
connect_db();
?>
<html lang="fr">

  <head>
  	<meta charset="utf-8" />
  	<title>Search page</title>
		<link rel="stylesheet" type="text/css" href="signin.css">
  </head>

  <body>

<table style='width:40%';>
	<div id="pageresults">
	<h2> Results :</h2>
<?php

	$query_sql = "";
	$field_form = ["accessionnb","species","strain","seq_length", "seq_nt"];
	$db_gc_col = ["accessionnb","species","strain","seq_length","seq_nt"];
	for ($i = 0; $i <= 4; $i++) {
		$ff =  $field_form[$i];
		$gc = $db_gc_col[$i];
		if (!empty($_GET[$ff])){
			if (strlen($query_sql) > 5){

				if($ff != "seq_nt"){
					$query_sql .= "AND ".$gc."='".$_GET[$ff]."'";
				}else{
					$query_sql .= "AND ".$gc." LIKE '%".$_GET[$ff]."%' ";
				}
				
			}else{
				if($ff != "seq_nt"){
					$query_sql .= "SELECT * FROM w_gene.genome WHERE ".$gc."='".$_GET[$ff]."'";
				}else{
					$query_sql .= "SELECT * FROM w_gene.genome WHERE ".$gc." LIKE '%".$_GET[$ff]."%' ";
					
				}
				
			}
		}
	}
	if(strlen($query_sql) > 5){
		$query_sql .= ";";
		$result = pg_query($db_conn,$query_sql);
        if (!$result) {
            echo "Une erreur s'est produite.\n";
            exit;
        }
        else if(pg_num_rows($result) == 0) {
            $result_2 = pg_query($db_conn,"SELECT * FROM w_gene.genome;");
            echo " <div style='font-size:150%'> Aucun résultat </div> <br> <br> <br>";
            echo " <td colspan='5'> Accessionnb Species Genre Strain Sequence_length </td>";
            while ($row = pg_fetch_assoc($result_2) ){
                echo "<div style='font-size:110%'> 
		<br><tr>
            	<td> <a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a></td> 
	    	<td>".$row['species']."</td>
	    	<td>".$row['strain']."</td>
	    	<td>".$row['seq_length']."</td>
       		</tr> </div>";

            }
        }
        else if(pg_num_rows($result) != 0) {
            $array_id = array();
            echo " <td colspan='4'> Accessionnb Species Strain Sequence_length </td>";
            while ($row = pg_fetch_assoc($result) ){
                echo "<br><tr>
            	<td> <a href='Results_genome.php?id=".$row['accessionnb']."'> ".$row['accessionnb']."</a> </td>  
	    	<td>".$row['species']."</td>
	    	<td>".$row['strain']."</td>
	    	<td>".$row['seq_length']."</td>
       		</tr>";
                $array_id[] = $row['accessionnb'];

            }

        }
	}
	



	


disconnect_db();
?>



</table>
</div>

</body>

</html>
