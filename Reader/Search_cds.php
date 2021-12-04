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
        <h2> Résultats :</h2>
        <?php

        $query_sql = "";
        $info_formulaire = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
        $col_table = ["idsequence","accessionnb","dna_type","cds_start","cds_end","strand","cds_seq", "cds_size", "pep_seq", "pep_size", "geneid", "genebiotype", "transcriptbiotype", "genesymbol", "description"];
        for ($i = 0; $i <= 15; $i++) {
            $ch = $info_formulaire[$i];
            $col = $col_table[$i];
            if ($col=="accessionnb" AND $col=="idsequence"){
                $col = "sequence.".$col;
                $col= "annotation.".$col;
            }
//            else if ($col=="idsequence"){
//                $col = "annotation.".$col;
//            }
            if (!empty($_POST[$ch])){
                if (strlen($query_sql) > 5){
                    if(($ch != "cds_seq")&&($ch != "pep_seq")){
                        $query_sql .= "AND ".$col."='".$_POST[$ch]."'";
                    }else{
                        $query_sql .= "AND ".$col." LIKE '%".$_POST[$ch]."%' ";
                    }

                }else{
                    if(($ch != "cds_seq")&&($ch != "pep_seq")){
                        $query_sql .= "SELECT * FROM w_gene.genome,w_gene.sequence, w_gene.annotation WHERE genome.accessionnb = sequence.accessionnb AND sequence.idsequence = annotation.idsequence AND ".$col." ='".$_POST[$ch]."'";
                    }else{
                        $query_sql .= "SELECT * FROM w_gene.genome,w_gene.sequence, w_gene.annotation WHERE genome.accessionnb = sequence.accessionnb AND sequence.idsequence = annotation.idsequence AND ".$col." LIKE '%".$_POST[$ch]."%'";

                    }

                }
            }
        }

        if(strlen($query_sql) > 5){
            $query_sql .= "ORDER BY cds_start;";
            echo "<br>";
            //echo $query_sql;
            $res = pg_query($db_conn,$query_sql);
        }

        if (!$res) {
            echo "Une erreur s'est produite.\n";
            echo pg_last_error($db_conn);
            exit;
        }

        if(pg_num_rows($res) == 0) {
            echo " <br><div style='font-size:150%'> Aucun résultat </div> <br> <br>";
        }

        if(pg_num_rows($res) != 0) {
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
        disconnect_db();
        ?>
</table>

</body>

</html>
