<?php
//This page is dedicated to dispaly the assigned sequences for annotators and it is linked to the annot_seq.php page
//Connexion to database
require_once 'db_utils.php';
connect_db();
//Retreive the annot email from the login
$annotator=$_SESSION["session_login"];
//Extract from the database the sequences assigned by tha validator:
$to_annotate_query = "SELECT idSequence, AccessionNb, pep_seq FROM w_gene.sequence WHERE annot=2 and email_annot=$1";
$to_annotate_results=pg_query_params($db_conn, $to_annotate_query,array($annotator)) or die(pg_last_error());
$number_to_annotate=pg_num_rows($to_annotate_results);
//If the annotator does not  have any sequence to annotate:
if($number_to_annotate == 0){
    echo "Unfortunately there is no sequence to annotate";
} else { //If the annotator dhave  sequence(s) to annotate:
echo "<table class='table'><thead><tr>
        <th>Id Sequence</th>
        <th>Genome accession number</th>
        <th>Peptidic sequence</th></thead></tr>";
//When the annotator choose sequence to annotate he will be directed to the form page to annotate the chosen sequence
while($annotation=pg_fetch_assoc($to_annotate_results)){
    echo "<tbody><tr><td data_label='Id Sequence'><button value ='". $annotation['idsequence'] ."' onclick='window.location.href=\"annot_design2.php?id=".$annotation['idsequence']."\"'>". $annotation['idsequence'] ."</button></td>
            <td data_label='Genome accession number'>".$annotation['accessionnb']."</td>
            <td data_label='Peptidic sequence'> <p class='sequence' style='overflow-wrap: break-word; width: 800px;'>".$annotation['pep_seq']."</p></td>
        </tr></tbody>";
    }
echo "</table>";
}
disconnect_db();
?>