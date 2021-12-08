<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html lang="en">

  <head>
  	<meta charset="utf-8" />
  	<title>Search page Genome</title>
		<link rel="stylesheet" type="text/css" href="search_form.css">
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
          <div class="title"> Genomes Results List </div><br>
          <table border = 1>
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

                //TODO : faire un joli grand tableau avec le CSS
                else if(pg_num_rows($result) != 0) { //Results
                    echo " <td><strong>Accession Number</strong></td>
                           <td><strong>Species</strong></td>
                           <td><strong>Strain</strong></td>
                           <td><strong>Sequence length</strong></td>";

                    while ($row = pg_fetch_assoc($result) ){
                        echo "<tr>
                                   <td><a href='Results_genome2.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  
                                   <td>".$row['species']."</td>
	    	                       <td>".$row['strain']."</td>
                                   <td>".$row['seq_length']."</td>
                                   </tr>";
                        }
                    }
            }
            disconnect_db();
            ?>
          </table>
      </div>
</body>
</html>
