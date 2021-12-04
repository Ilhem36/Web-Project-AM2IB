<!DOCTYPE html>
<?php require_once 'db_utils.php';
connect_db();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title> Search cds & peptides </title>
    <link rel="stylesheet" type="text/css" href="signin.css">

</head>
<body>

<table style='width:40%';>
    <div id="pageresults">
        <h2> Queries results :</h2>
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
        $query_sql .= "ORDER BY cds_start;";
        echo "<br>";
        //echo $query_sql;
        $res = pg_query($db_conn,$query_sql);
        if (!$res) {
            echo "Une erreur s'est produite.\n";
            exit;
        }
        else if(pg_num_rows($res) == 0) {
            echo " <br><div style='font-size:150%'> Aucun résultat </div> <br> <br>";
        }

        else if  (pg_num_rows($res) != 0) {
            $array_id = array();
            echo " <td colspan='5'> IDseq dna_type cds_start cds_end strand cds_size pep_size</td>";
            while ($row = pg_fetch_assoc($res) ){
                echo "<br><tr>
                    <td> <a href='Results_cds.php?id=".$row['idsequence']."'> ".$row['idsequence']."</a></td>  
                <td>".$row['dna_type']."</td>
                <td>".$row['cds_start']."</td>
                <td>".$row['cds_end']."</td>
                <td>".$row['strand']."</td>
                <td>".$row['cds_size']."</td>
                <td>".$row['pep_size']."</td>
                </tr>";
                //TODO: finir de rajouter les autres
                //$array_id[] = $row['idseq'];

            }

        }
    }
    disconnect_db();
        ?>
</table>
</div>
</body>

</html>
