<!DOCTYPE html>
<?php require_once 'db_utils.php';
    connect_db();
?>
<html lang="fr">

  <head>
  <meta charset="utf-8" />
        <title>Reader page</title>
	 <link rel="stylesheet" type="text/css" href="signin.css">
  </head>

  <body>
  <div class="container">
      <div class="title"> Search:  </div>
      <div class="sidenav"> <br>
              <button id="search_gen" name="search_gen" onclick = "location.href = 'Form_genome.php'"><br>Genome queries</button><br>
              <button id="search_cds" name="search_cds"><br>CDS/Peptides [A FAIRE]</button><br>
      </div>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get"><!--quand on clique sur le bouton results_list -> affiche la liste de tous les résultats pour génome-->
        <div class="button">
              <input type="submit" name="results_list" value="results_list">
        </div>
        </form>

      <div id="pageresults">
      <table width=100% border=2>
      <?php
        if (isset($_GET['results_list'])) :
	    $res = pg_query($db_conn,"SELECT * FROM w_gene.genome");
	    if(pg_num_rows($res) != 0) {
		    echo " <td> accessionnb </td><td> species </td><td> strain </td><td> seq_length </td>";
		    while ($row = pg_fetch_assoc($res)){
		    echo "<tr>
            	<td> <a href='Results_genome.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a> </td>  
	    	    <td>".$row['species']."</td>
	    	    <td>".$row['strain']."</td>
	    	    <td>".$row['seq_length']."</td>
       		    </tr>";
	        }
        }
        endif;
        disconnect_db();
        ?>
      </table>
      </div>
</div>
</body>
</html>
<!--TODO : Rajouter affichage liste résultats pour gènes et peptides-->