<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Search cds & peptides </title>
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
    <div class="title"> CDS & Peptides Results List </div><br>
        <table border = 1>
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
                echo "<td><strong>Sequence ID</strong></td>
                           <td><strong>Accession Number (Genome)</strong></td>
                           <td><strong>DNA type</strong></td>
                           <td><strong>CDS start position</strong></td>
                           <td><strong>CDS end position</strong></td>
                           <td><strong>Strand</strong></td>
                           <td><strong>CDS length</strong></td>
                           <td><strong>Peptide size</strong></td>
                           <td><strong>Gene ID</strong></td>
                           <td><strong>Gene biotype</strong></td>
                           <td><strong>Transcript biotype</strong></td>
                           <td><strong>Gene Symbol</strong></td>
                           <td><strong>Description</strong></td>";

            while ($row = pg_fetch_assoc($res) ){
                echo "<tr>
                      <td><a href='Results_cds.php?id=".$row['idsequence']."'>".$row['idsequence']."</a></td>  
                      <td><a href='Results_genome.php?id=".$row['accessionnb']."'>".$row['accessionnb']."</a></td>  
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
    }
    disconnect_db();
        ?>
</table>
</div>
</body>
</html>
