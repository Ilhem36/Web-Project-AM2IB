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
              <button id="search_cds" name="search_cds" onclick = "location.href = 'Form_cds.php'"><br>CDS/Peptides</button><br>
      </div>


      <?php
        disconnect_db();
      ?>

</div>
</body>
</html>
<!--TODO : Rajouter affichage liste résultats pour gènes et peptides-->