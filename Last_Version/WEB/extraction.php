<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- This page is dedicated to extract annotated fields from database -->
<?php
if (isset($_POST['download'])) {
    require_once 'db_utils.php';
    connect_db();
    $extract_query= "SELECT genome.accessionnb, sequence.idsequence";
    if (isset($_POST['extract'])){
        $nb_field = 0;
        foreach ($_POST['extract'] as $field){
            $extract_query.= ", $field";
            $nb_field +=1;
        }
        $extract_query.= " FROM w_gene.genome,w_gene.sequence, w_gene.annotation WHERE genome.accessionnb = sequence.accessionnb AND sequence.idsequence = annotation.idsequence AND annot=1";
        $result = pg_query($db_conn,  $extract_query);
        $filename = "extract_filed$nb_field.txt";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        header("Content-Transfer-Encoding: UTF-8");
        $file = fopen($filename, "w");
        while ($row = pg_fetch_assoc($result)) {
            fputcsv($file, $row, ";");
        }
        fclose($file);
        if (file_exists($filename)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }
    }
}
echo '<b>Choose the field you want to extract:</b><br>
    <form action ="'.$_SERVER["PHP_SELF"].'" method ="post">
    <input type="checkbox" id="box1" name="extract[]" value="species, strain">
    <label for="box1"> Specie and strain </label>
    <!--id_transcript-->
    <input type="checkbox" id="box2" name="extract[]" value="dna_type">
    <label for="box2"> dna_type</label>
    <input type="checkbox" id="box3" name="extract[]" value="geneid">
    <label for="box3"> Gene ID</label><br>
    <input type="checkbox" id="box4" name="extract[]" value="cds_start,cds_end">
    <label for="box4"> Localisation of gene in genome</label>
    <input type="checkbox" id="box5" name="extract[]" value="strand">
    <label for="box5"> Strand</label><br>   
    <input type="checkbox" id="box6" name="extract[]" value="GeneBiotype,TranscriptBiotype">
    <label for="box6"> Gene and transcript biotype</label>    
    <input type="checkbox" id="box7" name="extract[]" value="genesymbol">
        <label for="box7"> Gene symbol</label>
    <input type="checkbox" id="box8" name="extract[]" value="description">
    <label for="box8"> Function of protein </label>
    <button class="big_submit_button" name="download" type="submit" value="download"> Download</button> 
    </form>';
?>
</html>

