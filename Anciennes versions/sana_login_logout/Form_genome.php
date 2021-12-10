<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>
  <head>
  <meta charset="utf-8" />
        <title> Genomes Search Form </title>
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

	<!-- Formulaire de recherches sur la table génome -->
 	<div class ="container">
        <div class="title"> Search information about Genomes </div><br>
		<form action="Search_genome.php" method="get">
            <div class="form-details">
                <div class = "input-box">

                <strong>Accession number : </strong>
		        <input type="text" placeholder="Enter the accession number" name="accessionnb"><br><br>

                <strong> Species :</strong>
		        <input type="text" placeholder="Enter the species" name="species"><br><br>

                <strong> Strain :</strong>
		        <input type="text" placeholder="Enter the strain" name="strain"><br><br>

                <strong>Sequence length :</strong>
		        <input type="text" placeholder="Enter the seq. length" name="seq_length"><br><br>

                <strong>Genome complete sequence :</strong><br>
    	        <textarea id="textarea" rows="10" cols="55" name="seq_nt" placeholder = "Enter the sequence" minlength="4"></textarea>

                    <div class="button">
		            <input type="submit" value="Search"><br>
                    </div>
            </div>
		</form>
	</div>
  </body>
</html>

<?php
disconnect_db();
?>


  

