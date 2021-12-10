<?php
//This is the page where we prepare the sql queries and display the results in a table with only the id sequence of the cds and the associated accession number (both clickable)
require_once 'db_utils.php';
connect_db();//connexion to the database
//Start session for the login
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <title> Search cds & peptides </title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>

<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <!-- This part is to display navigation bar according to the role of user -->
            <?php require_once 'Menu.php' ; ?>
            <!-- Welcome message for the user -->
            <br><br>
            <div class = "hello">
                <?php
                echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                ?>
            </div>
        </ul>
    </div>
</nav>
         <!-- Gene and Protein Results List-->
        <?php
            $query_sql = ""; //initialisation
            //the values from the form Form_cds.php
            $field_form = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
            //the attributs from the sql table sequence and annotation 
            $db_CDS_col = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
            for ($i = 0; $i <= 14; $i++) {
                $ff = $field_form[$i]; 
                $field = $db_CDS_col[$i];
                if ( $field=="idsequence"){ //specify "annotation.idsequence" in the query
                    $field= "annotation.".$field;
                }
                if (!empty($_POST[$ff])){ //if the fields from the form are not empty
                    if (strlen($query_sql) > 4){
                        if(($ff != "cds_seq")&&($ff != "pep_seq")){ //if we don't request for cds or peptide sequence 
                            $query_sql .= "AND ".$field."='".$_POST[$ff]."'"; //add to the sql query the values that the user put in the form fields   
                        }else{
                            $query_sql .= "AND ".$field." LIKE '%".$_POST[$ff]."%' "; //if the equal does not function, we try with LIKE%xxx%
                        }

                    }else{
                        if(($ff != "cds_seq")&&($ff != "pep_seq")){ 
                            $query_sql .= "SELECT * FROM w_gene.sequence, w_gene.annotation WHERE  sequence.idsequence = annotation.idsequence AND ".$field." ='".$_POST[$ff]."'";
                        }else{
                            $query_sql .= "SELECT *  FROM w_gene.sequence, w_gene.annotation WHERE sequence.idsequence = annotation.idsequence AND ".$field." LIKE '%".$_POST[$ff]."%'";
                        }
                    }
                }
            }

            if(strlen($query_sql) > 4){
                $query_sql .= "ORDER BY cds_start;"; //display the genome by ordered by cds start position
                echo "<br>";
                $res = pg_query($db_conn,$query_sql);

                if (!$res) {//No results
                    echo "An error has occurred. Please, retry.\n";
                exit;
                }

                else if(pg_num_rows($res) == 0) {//no results
                    echo "<div class ='container message' > There is no result for your request.<br></div>";
                }

            else if (pg_num_rows($res) != 0) {//display results in a table
                echo "<div class ='container'>
                      <table class='table'>
                      <thead>
                      <tr>  
                        <th>Sequence ID</th>
                        <th>Accession Number (Genome)</th>
                      </tr>
                      </thead>";

            while ($row = pg_fetch_assoc($res) ){
                echo "<tr>
                      <td><a href='Results_cds.php?id=".$row['idsequence']."'>".$row['idsequence']."</a></td>  
                      <td><a href='Results_genome2.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  
                      </tr>";
            }
        }
        echo "</table>";
        echo "</div>";
    }
    ?>
</body>
</html>
<?php   disconnect_db(); //deconnexion from the database ?>