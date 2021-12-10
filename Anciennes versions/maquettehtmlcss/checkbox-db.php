<?php

$servername = "localhost";
$username = "postgres";
$password = "Think13";
$dbname = "essaye";

$conn = pg_pconnect("host=$servername dbname=$dbname  user=$username  password=$password");
if (!$conn) {
    echo "Please check your connection\n";
    exit;
}

if (isset($_POST['submit'])) {
    $checked_array = $_POST['idsequence'];
    foreach ($_POST['idsequence'] as $key => $value) {
        if (in_array($_POST['idsequence'][$key], $checked_array)) {
            $idsequence = $_POST['idsequence'][$key];
            $gene_id = $_POST['gene_id '][$key];
            $gene_biotype = $_POST['gene_biotype'][$key];
            $transcript_biotype = $_POST['transcript_biotype'][$key];
            $gene_symbol = $_POST['gene_symbol'][$key];
            $description = $_POST['description'][$key];
            # ici plutot update
            $insertqry = "UPDATE  essaye.annot SET gene_id='$gene_id',gene_biotype='$gene_biotype', transcript_biotype='$transcript_biotype',gene_symbol='$gene_symbol',description='$description' where idsequence=$idsequence)";
            $insertqry = pg_query($conn, $insertqry);
        }
    }
}
?>
