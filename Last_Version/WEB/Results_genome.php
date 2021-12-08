<!DOCTYPE html>
<?php require_once 'db_utils.php';
# connexion à la base : affiche "connection failed" si pas de connection
connect_db();
?>
<html>

<head>

    <meta charset="utf-8" />
        <title> Results pages</title>
    <link rel="stylesheet" type="text/css" href="signin.css">
</head>

<body>

<!-- Fiche Genome -->
<div class='container'>
    <div class="title">Genome Results</div>
        <table>
            <?php
            if (isset($_GET['submit'])) {
                $a = $_GET['Start'];
                $b = $_GET['End'];
                //Refresh page
                header('Results_genome.php');
            }
            //Link from the genome form page
            $str = $_SERVER['REQUEST_URI'];
            //Split to get  genome accession number
            $keywords = preg_split("/=/", $str);
            //Get the accession number
            //$accessionnb = $keywords[1]; // id recupéré de l'url
            //$genome=$keywords[5];
            //$accessionnb=array_column($field_form, 'accessionnb');
            print_r($keywords);
            #Execute the query to store the  genome sequence
            $res1 = pg_query($db_conn, "SELECT * FROM w_gene.genome WHERE accessionnb='ASM744v1';");

            if (!$res1) {
                echo "An error has occurred.\n";
                exit;
            }
            //Get genome information:
            while ($row1 = pg_fetch_assoc($res1)) {
                echo "<div style='font-size:110%'> 
                        <tr><th> Accession Number </th><td>" . $row1['accessionnb'] . "</td></tr><br>
                        <tr><th> Species </th><td>" . $row1['species'] . "</td></tr><br>
                        <tr><th> Strain </th><td>" . $row1['strain'] . "</td></tr><br>
                        <tr><th> Sequence length </th><td>" . $row1['seq_length'] . "</td></tr><br>
                    </div>";
                //get genome sequence
                print_r($row1);
                    $genome = $row1['seq_nt'];
            }

             ?>
    </table>
    <form action="Results_genome.php" method="get">
        <div class="genelim">
            <span class="details">Start</span>
            <input type="text" name="Start" placeholder="Start" required>
        </div>
        <div class="genelim">
            <span class="details">End</span>
            <input type="text" name="End" placeholder="End" required>
        </div>
        <div class="button">
            <input type="submit" name="submit" value="submit">
        </div>
    </form>
            <?php
            #Get CDS ID and information:
            $query = "SELECT * FROM w_gene.sequence WHERE accessionnb='ASM744v1' AND cds_end >= " . $a . " AND cds_start <= " . ($b) . ";";
            $res2 = pg_query($db_conn, $query);
            if (!$res2) {
                echo "An error has occurred.\n";
                exit;
            }
            //Get php array from the query:
            $res2table = pg_fetch_all($res2);
            //  Sort table according to the CDS start
            array_multisort($debutsequence = array_column($res2table, 'cds_start'), SORT_ASC, $res2table);
            //Set variables to store information about the CDS
            $sequence = array_column($res2table, 'cds_seq');
            $debutsequence = array_column($res2table, 'cds_start');
            $finsequence = array_column($res2table, 'cds_end');
            $longsequence = array_column($res2table, 'cds_size');
            $idsequence = array_column($res2table, 'idsequence');
            ?>

    <h4>Sequence : </h4>
    <div class="card-container">
        <div class="card">
            <div class="genome">
                <?php
                //Select the  genome part we want to visualize
                $partial_genome = substr($genome, $a, $b-$a);
                echo $partial_genome;
                ?>

                <?php
                //Set variables for the css
                $char_width = 10;
                $space = 34;
                for ($k = $a; $k <= $b; $k = $k + 10) {
                    $style = 'style="left:' . $k-$a . 'ch "';
                    echo '<div class="labely"  ' . $style . '><div class="labeltext">';
                    echo $k;
                    echo '</div></div>';
                    echo '<div class="label-bar" ' . $style . '></div>';
                }
                // Get non overlapping button
                $Niv = array_fill(0, 99, 0);
                for ($i = 0; $i < count($sequence); $i++) {
                    $j = 0;
                    while ($debutsequence[$i] < $Niv[$j]) :
                        $j++;
                    endwhile;
                    $Niv[$j] = $finsequence[$i];
                    //ch is a character unit
                    echo '<input type="button" value="' . $idsequence[$i] . '" class="bouton-seq-container" style="top: ' . (($j) * $space + 20) . 'px; left: ' . $debutsequence[$i]-$a . 'ch; width: ' . $longsequence[$i] . 'ch">';
                    echo '</input>';
                };
                ?>

            </div>

        </div>
    </div>
</div>


</body>
</html>