<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- This page is dedicated to extract annotated fields from database -->
<head>
    <meta charset="utf-8" />
    <title>Reader page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>
<body>

<div class ="container">
    <div class="title"> Download data </div><br>
<?php
if (isset($_POST['download'])) { //if the user click on the download button
    require_once 'db_utils.php';
    connect_db(); //connexion to the database
    $extract_query= "SELECT genome.accessionnb, sequence.idsequence"; //prepare the extraction query
    if (isset($_POST['extract'])){ //if the checkbox is selected
        $field_count = 0; //initialise the number of selected fields
        foreach ($_POST['extract'] as $field){ //for each checkbox, stock it in the variable "field"
            $extract_query.= ", $field";
            $field_count +=1; //incrementation
        }
        $extract_query.= " FROM w_gene.genome,w_gene.sequence, w_gene.annotation WHERE genome.accessionnb = sequence.accessionnb AND sequence.idsequence = annotation.idsequence AND annot=1";
        $result = pg_query($db_conn,  $extract_query);
        $filename = "extract_filed$field_count.txt";
        header('Content-Type: text/txt; charset=utf-8'); //download doc type
        header('Content-Disposition: attachment; filename=' . $filename); //specify the name of the file
        $file = fopen($filename, "w"); //open the file
        while ($row = pg_fetch_assoc($result)) {
            fputcsv($file, $row, ";"); //write the result of the prepared query to download, the separator is a ";"
        }
        fclose($file); //close the file
        if (file_exists($filename)) { //if the file already exist, force the downloading
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
            exit;
        }
    }
}
//This form allows the user to choose which sql attributes and values the user wants to download
echo '<b>Choose the field you want to extract:</b><br><br>
    <form action ="'.$_SERVER["PHP_SELF"].'" method ="post">
    
    <!--The accession number and the id sequence are already selected in the sql request--> 
    <input type="checkbox" id="box1" name="extract[]" value="species, strain">
    <label for="box1"> Species and strain </label><br>
    
    <input type="checkbox" id="box2" name="extract[]" value="dna_type">
    <label for="box2"> DNA type</label><br>
    
    <input type="checkbox" id="box3" name="extract[]" value="geneid">
    <label for="box3"> Gene ID</label><br>
    
    <input type="checkbox" id="box4" name="extract[]" value="cds_start,cds_end">
    <label for="box4"> CDS start and end position</label><br>
    
    <input type="checkbox" id="box5" name="extract[]" value="strand">
    <label for="box5"> Strand</label><br>   
    
    <input type="checkbox" id="box6" name="extract[]" value="GeneBiotype,TranscriptBiotype">
    <label for="box6"> Gene and transcript biotype</label><br>
    
    <input type="checkbox" id="box7" name="extract[]" value="genesymbol">
        <label for="box7"> Gene symbol</label><br>
        
    <input type="checkbox" id="box8" name="extract[]" value="description">
    <label for="box8"> Function of protein </label><br>
    <br>
        <!--download button-->
    <button class="btn btn--assign" name="download" type="submit" value="download"> Download</button> 
    </form>';
?>
    </body>
</html>

