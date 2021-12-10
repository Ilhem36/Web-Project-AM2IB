<?php
//NON UTILISE
require_once 'db_utils.php';
connect_db();
$email_annot = "annotateur@psud.fr"; /*$1*/
$insert_annotation_query = "INSERT INTO w_gene.annotation(email_annot, date_annot, geneid, idsequence, genebiotype, transcriptbiotype, genesymbol, description, status) VALUES ($1,'now',$2,$3,$4,$5,$6,$7,0)";
$update_sequence_query = "UPDATE w_gene.sequence SET annot=1 WHERE idsequence=$1";
//ID sequence to display
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    echo "You have chosen ".$id;
}else{
    echo "No sequence id given";
}

if(isset($_POST['submit'])){
    $gene_id = $_POST["gene_id"];
    $gene_biotype = $_POST["gene_biotype"];
    $transcript_biotype = $_POST["transcript_biotype"];
    $gene_symbol = $_POST["gene_symbol"];
    $description = $_POST["Description"];
    if (empty($gene_symbol)){
        $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,null,$description)) or die(pg_last_error());
    } else {
        $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,$gene_symbol,$description)) or die(pg_last_error());
    }
    $update_sequence=pg_query_params($db_conn,$update_sequence_query,array($id)) or die(pg_last_error());
    echo "Your annotation was submitted successfully";
}
//
//#$query="SELECT idsequence FROM web_gene.annotation where email_annot='".$_SESSION['username']."' and status=0";
//if(isset($_POST['submit'])&&!empty($_POST['submit'])){
//
//$sql = "update  annot SET idsequence='A555',gene_id='".$_POST['gene_id']."',gene_biotype='".$_POST['gene_biotype']."',transcript_biotype='".$_POST['transcript_biotype']."',gene_symbol='".$_POST['gene_symbol']."',description='".$_POST['Description']."' where email_annot='".$_POST['email_annot']."'";
//$ret = pg_query($dbconn, $sql);
//if($ret){
//
//echo "Data saved Successfully";
//}else{
//
//echo "Something Went Wrong";
//}
//}
?>
