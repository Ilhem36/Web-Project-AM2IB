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
    	<?php
        $str=$_SERVER['REQUEST_URI'];
	    $keywords = preg_split("/=/", $str);
	    $accessionnb= $keywords[1];

        $result = pg_query($db_conn,"SELECT * FROM w_gene.genome WHERE accessionnb='".$accessionnb."';");
	    if (!$result) {
 		    echo "Une erreur s'est produite.\n";
  	    exit;
	    }

        while ($row = pg_fetch_assoc($result)){
	        echo "<tr><th> Accession Number : </th><td> ".$row['accessionnb']."</td></tr>
	              <tr><th> Species : </th><td> ".$row['species']."</td></tr>
	              <tr><th> Strain : </th><td> ".$row['strain']."</td></tr>
	              <tr><th> Sequence length : </th><td> ".$row['seq_length']."</td></tr>";
                  $seq_nt = $row['seq_nt'];
	    }
        ?>
        </table>

        <br><br>

        <strong>Genome Sequence : </strong>
        <textarea name="text" cols="55" rows="20" id="text">
            <?php echo $seq_nt; ?>
        </textarea>

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


