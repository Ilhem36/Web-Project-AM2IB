<?php
//This is the page where we prepare the sql queries and display the results in a table, the accession number is cliquable and leads to Result_genome.php page
require_once 'db_utils.php';
connect_db();//connexion to the database
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  	<meta charset="utf-8" />
  	<title>Search page Genome</title>
		<link rel="stylesheet" type="text/css" href="search_cds.css">
  </head>

  <body>
  <nav>
      <div class="nav-content">
          <div class="logo">
              <a href="Home_page.php">GenAnnot.</a>
          </div>
          <ul class="nav-links">
              <?php require_once 'Menu.php' ; ?>

              <br><br>
              <div class = "hello">
                  <?php
                  echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                  ?>
              </div>

          </ul>
      </div>
  </nav>

          <!-- Genomes Results List-->
          <?php
	        $query_sql = "";//initialisation
	  //the values from the form Form_genome.php
	        $field_form = ["accessionnb","species","strain","seq_length", "seq_nt"];
	   //the attributs from the sql table genome 
	        $db_gc_col = ["accessionnb","species","strain","seq_length","seq_nt"];
	        for ($i = 0; $i <= 4; $i++) {
		        $ff =  $field_form[$i];
		        $gc = $db_gc_col[$i];
                if (!empty($_GET[$ff])){//if the fields from the form are not empty
			        if (strlen($query_sql) > 5){
				        if($ff != "seq_nt"){//if we don't request for genome sequence 
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
		        $query_sql .= ";"; //put a comma to the end of the sql query
		        $result = pg_query($db_conn,$query_sql); //the sql query is prepared and stocked in "result" variable 
                if (!$result) {//No results
                    echo "An error has occurred. Please, retry.\n";
                exit;
                }

                else if(pg_num_rows($result) == 0) { //No results
                    echo "There is no result for your request. <br>";
                }

                else if(pg_num_rows($result) != 0) { //Display Results in a table
                    echo "<table class='table'>
                          <thead>
                          <tr>
                            <th>Accession Number</th>
                            <th>Species</th>
                            <th>Strain</th>
                            <th>Sequence length</th>
                          </tr>
                          </thead>";
                    while ($row = pg_fetch_assoc($result) ){
                        echo "<tr>
                                   <td><a href='Results_genome2.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  //the accession number is clickable
                                   <td>".$row['species']."</td>
	    	                       <td>".$row['strain']."</td>
                                   <td>".$row['seq_length']."</td>
                              </tr>";
                        }
                    }
                    echo "</table>";
            }
            disconnect_db(); //deconnexion from the database
            ?>
</body>
</html>
