<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <title> Search cds & peptides </title>
    <link rel="stylesheet" type="text/css" href="search_cds.css">
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

         <!-- Gene and Protein Results List-->
        <?php
            $query_sql = "";
            $field_form = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
            $db_CDS_col = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
            for ($i = 0; $i <= 14; $i++) {
                $ff = $field_form[$i];
                $field = $db_CDS_col[$i];
                if ( $field=="idsequence"){
                    $field= "annotation.".$field;
                }
                if (!empty($_POST[$ff])){
                    if (strlen($query_sql) > 4){
                        if(($ff != "cds_seq")&&($ff != "pep_seq")){
                            $query_sql .= "AND ".$field."='".$_POST[$ff]."'";
                        }else{
                            $query_sql .= "AND ".$field." LIKE '%".$_POST[$ff]."%' ";
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
                $query_sql .= "ORDER BY cds_start;"; //pour afficher les cds dans l'ordre d'apparition sur le génome
                echo "<br>";
                $res = pg_query($db_conn,$query_sql);

                if (!$res) {
                    echo "An error has occurred. Please, retry.\n";
                exit;
                }

                else if(pg_num_rows($res) == 0) {
                    echo "There is no result for your request.<br>";
                }

            else if (pg_num_rows($res) != 0) {
                echo "<table class='table'>
                      <thead>
                      <tr>  
                        <th>Sequence ID</th>
                        <th>Accession Number (Genome)</th>
                        <th>DNA type</th>
                        <th>CDS start position</th>
                        <th>CDS end position</th>
                        <th>Strand</th>
                        <th>CDS length</th>
                        <th>Peptide size</th>
                        <th>Gene ID</th>
                        <th>Gene biotype</th>
                        <th>Transcript biotype</th>
                        <th>Gene Symbol</th>
                        <th>Description</th>
                      </tr>
                      </thead>";

            while ($row = pg_fetch_assoc($res) ){
                echo "<tr>
                      <td><a href='Results_cds.php?id=".$row['idsequence']."'>".$row['idsequence']."</a></td>  
                      <td><a href='Results_genome2.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  
                      <td>".$row['dna_type']."</td>
                      <td>".$row['cds_start']."</td>
                      <td>".$row['cds_end']."</td>
                      <td>".$row['strand']."</td>
                      <td>".$row['cds_size']."</td>
                      <td>".$row['pep_size']."</td>
                      <td>".$row['geneid']."</td>
                      <td>".$row['genebiotype']."</td>
                      <td>".$row['transcriptbiotype']."</td>
                      <td>".$row['genesymbol']."</td>
                      <td>".$row['description']."</td>
                      </tr>";
            }
        }
        echo "</table>";
    }
    disconnect_db();
    ?>
</body>
</html>
