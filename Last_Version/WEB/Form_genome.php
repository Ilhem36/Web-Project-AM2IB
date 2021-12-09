<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db(); //connexion to the database
?>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
        <title> Genomes Search Form </title>
	 <link rel="stylesheet" type="text/css" href="reader.css">
  </head>

 <body>
 <nav>
     <div class="nav-content">
         <div class="logo">
             <a href="Home_page.php">GenAnnot.</a>
         </div>
         <ul class="nav-links">
             <li><a href="Home_page.php">Home</a></li>
             <li><a href="annot_in_progress.php">Annotations</a></li>
             <li><a href="#">Admin</a></li>
             <li><a href="#">Validator</a></li>
             <li><a href="#">Annotator</a></li>
             <li><a href="reader_Menu.php">Reader</a>
             <li><a href="signIn.php">Logout</a><br><br>
                 <div class = "hello">
                     <?php require_once 'db_utils.php';
                     connect_db();
                     session_start();
                     echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                     ?>
                 </div>
         </ul>
     </div>
 </nav>

    <!-- The user can search information by filling information in the fields in this form-->
	<!-- The form refers to Search_genome.php, where we prepare the SQL queries on the SQL table Genome from w_gene Database -->
 	<div class ="container">
        <div class="title"> Search information about Genomes </div><br>
		<form action="Search_genome.php" method="get"><!--A form method GET is used to get the values entered in the form fields-->
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
disconnect_db(); //deconnexion from the database
?>


  

