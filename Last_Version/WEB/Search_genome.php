<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html lang="en" dir="ltr">
  <head>
  	<meta charset="utf-8" />
  	<title>Search page Genome</title>
		<link rel="stylesheet" type="text/css" href="search.css">
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

          <!-- Genomes Results List-->
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
                    echo "An error has occurred. Please, retry.\n";
                exit;
                }

                else if(pg_num_rows($result) == 0) { //No results
                    echo "There is no result for your request. <br>";
                }

                else if(pg_num_rows($result) != 0) { //Results
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
                                   <td><a href='Results_genome2.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  
                                   <td>".$row['species']."</td>
	    	                       <td>".$row['strain']."</td>
                                   <td>".$row['seq_length']."</td>
                              </tr>";
                        }
                    }
                    echo "</table>";
            }
            disconnect_db();
            ?>
</body>
</html>
