<?php
require_once 'db_utils.php';
connect_db();

$annotator="annotateur@psud.fr";//ici il faut modifier pour récupérer l'email annot quand il se logue donc il faut mettre juste post et ne pas changer la ligne suivanta.
$to_annotate_query = "SELECT idSequence, AccessionNb, pep_seq FROM w_gene.sequence WHERE annot=2 and email_annot=$1";
$to_annotate_results=pg_query_params($db_conn, $to_annotate_query,array($annotator)) or die(pg_last_error());

$number_to_annotate=pg_num_rows($to_annotate_results);

if($number_to_annotate == 0){
    echo "Unfortunately there is no sequence to annotate";
} else { /*y a des annotations*/
echo "<table class='table-bordered'><tr>
        <td>Id Sequence</td>
        <td>Genome accession number</td>
        <td>Peptidic sequence</td></tr>";
while($annotation=pg_fetch_assoc($to_annotate_results)){
    echo "<tr><td><button value ='". $annotation['idsequence'] ."' onclick='window.location.href=\"annot_design.php?id=".$annotation['idsequence']."\"'>". $annotation['idsequence'] ."</button></td>
            <td>".$annotation['accessionnb']."</td>
            <td> <p class='sequence' style='overflow-wrap: break-word; width: 300px;'>".$annotation['pep_seq']."</p></td>
        </tr>";
    }
echo "</table>";
}
disconnect_db();
?>