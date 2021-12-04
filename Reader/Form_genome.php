<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>

  <head>

  <meta charset="utf-8" />
        <title> Formulaire de recherche </title>
	 <link rel="stylesheet" type="text/css" href="signin.css">

  </head>
 <body>

	<!-- Recherches sur la table génome -->
 	<div id= "searchSeqGenome2" >

		<form action="Search_genome.php" method="get">
		<h3> Rechercher un génome </h3>

        Accession nb :
		<input type="text" placeholder="accessionnb" name="accessionnb">

		Species :
		<input type="text" placeholder="species" name="species"> <br><br>
		
		Strain :
		<input type="text" placeholder="strain" name="strain">

        Seq length :
		<input type="text" placeholder="seq_length" name="seq_length"> <br><br>

		Genome sequence : <br>
    	<textarea id="txtArea" rows="10" cols="60" name="seq_nt" placeholder = "Genome sequence"></textarea><br><br>

		<input type="submit" value="search"/></button><br>
		</form>
	</div>
  </body>


</html>



  

