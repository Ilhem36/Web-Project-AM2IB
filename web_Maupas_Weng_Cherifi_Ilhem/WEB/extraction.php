<?php
require_once 'db_utils.php';
connect_db();//connexion to the database
session_start();
//When we click on an accession number from the page search_genome.php -> it leads to this page
//This is the results page for each genome
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- This page is dedicated to extract annotated fields from database -->
<head>
    <meta charset="utf-8" />
    <title>Reader page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>
<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <!--Display the navigation bar for annotators-->
            <?php require_once 'Menu.php' ; ?>

            <br><br>
            <div class = "hello">
                <!-- Welcome message for the user -->
                <?php
                echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                ?>
            </div>
        </ul>
    </div>
</nav>

<div class ="container">
    <div class="title"> Download data </div><br>
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
    <label for="box1"> Specie and strain </label><br>
    <!--id_transcript-->
    <input type="checkbox" id="box2" name="extract[]" value="dna_type">
    <label for="box2"> dna_type</label><br>
    <input type="checkbox" id="box3" name="extract[]" value="geneid">
    <label for="box3"> Gene ID</label><br>
    <input type="checkbox" id="box4" name="extract[]" value="cds_start,cds_end">
    <label for="box4"> Localisation of gene in genome</label><br>
    <input type="checkbox" id="box5" name="extract[]" value="strand">
    <label for="box5"> Strand</label><br>   
    <input type="checkbox" id="box6" name="extract[]" value="GeneBiotype,TranscriptBiotype">
    <label for="box6"> Gene and transcript biotype</label><br>    
    <input type="checkbox" id="box7" name="extract[]" value="genesymbol">
        <label for="box7"> Gene symbol</label><br>
    <input type="checkbox" id="box8" name="extract[]" value="description">
    <label for="box8"> Function of protein </label><br>
    <br>
    <button class="btn btn--assign" name="download" type="submit" value="download"> Download</button> 
    </form>';
    ?>
</html>
