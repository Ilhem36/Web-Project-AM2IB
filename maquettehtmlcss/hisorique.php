<?php
require_once 'db_utils.php';
connect_db();

$consult_annot_query='SELECT  idsequence, date_annot, geneid, genebiotype,transcriptbiotype,genesymbol,description,status,comments FROM w_gene.annotation where idsequence=$1';
$id = $_GET['id'];
$execute_query=pg_query_params($db_conn,$consult_annot_query,array($id))or die(pg_last_error());
while ($annot=pg_fetch_assoc($execute_query)){
    echo"<tr>
                <td>Idsequence: " . $annot['idsequence'] . " </td>
                <td>Annotation_Date: " . $annot['date_annot'] . "</td>
                <td>Gene_Id:" . $annot['geneid'] . "</td>
                <td>Gene_biotype:" . $annot['genebiotype'] . "</td>
                <td>Gene : " . $annot['transcriptbiotype'] . "</td>
                <td>Gene_Symbol: " . $annot['genesymbol'] . "</td>
                <td>Description: " . $annot['description'] . "</td>
                
                 <td> Status: <br>";
                 if ($annot['status']==2) {
                     echo "<p>Rejected</p>";
                 }else if($annot['status']==1) {
                     echo "<p>Rejected</p>";
                 }else {
                     echo  "<p>Being validated</p>";
                 }
                echo "<td>The comment: " . $annot['comments'] . "</td>
            </tr>";

}
?>
