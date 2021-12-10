<!DOCTYPE html>
<!-- This page id dedicated to assign sequences to annotators by the validator-->
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="assign.css">
</head>
<body>
<?php
// Connexion to database
require_once 'db_utils.php';
connect_db();
/* Pagination source code https://www.the-art-of-web.com/php/pagination/*/
//Page
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int)strip_tags($_GET['page']);
} else { /*no page number is defined*/
    $currentPage = 1;
}
$perpage = 20; /*Number of results per page*/
$precedent = ($currentPage - 1) * $perpage;

// Query to select annototors from database : Don't forget a validator or an admin are also annotators
$annotator_query = "SELECT email FROM w_gene.Users WHERE role in ('annotator','validator','admin')";
$annotator_results = pg_query($db_conn, $annotator_query) or die(pg_last_error());
/* Annotators list */
$annotator_results = pg_fetch_all_columns($annotator_results);

// Query to extract non annotated sequences:
$non_annotated_query = "SELECT idsequence FROM w_gene.Sequence WHERE annot=0 LIMIT $1 OFFSET $2";
$non_annotated_results = pg_query_params($db_conn, $non_annotated_query, array($perpage, $precedent)) or die(pg_last_error());
$non_annotated_results = pg_fetch_all_columns($non_annotated_results);
//Results number  for pagination:
$nr_results_query = "SELECT idsequence FROM w_gene.sequence WHERE annot=0";
$nr_results_result = pg_query($db_conn, $nr_results_query);
$nr_results_result = pg_num_rows($nr_results_result);

// Query to update the annot from not assigned (0) to 2 (assigned but not yet annotated)
$assign_query = "UPDATE w_gene.sequence SET annot=2, Email_annot=$1 WHERE idSequence=$2";

//Pagination
// Build array containing links to all pages
$tmp = [];
for ($p = 1, $i = 0; $i < $nr_results_result; $p++, $i += $perpage) {
    if ($currentPage == $p) {
        // current page shown as bold, no link
        $tmp[] = "<b>" . $p . "</b>";
    } else {
        $tmp[] = "<a href=\"?page=" . $p . "\">" . $p . "</a>";
    }
}

// Thin out the links
for ($i = count($tmp) - 3; $i > 1; $i--) {
    if (abs($currentPage - $i - 1) > 2) {
        unset($tmp[$i]);
    }
}

// Display navigation page if data covers more than one page
if (count($tmp) > 1) {
    echo "<p>";

    if ($currentPage > 1) {
        // display 'Prev' link
        echo "<a href=\"?page=" . ($currentPage - 1) . "\">&laquo; Prev</a> | ";
    } else {
        echo "Page ";
    }

    $lastlink = 0;

    foreach ($tmp as $i => $link) {
        if ($i > $lastlink + 1) {
            echo " ... "; // where one or more links have been omitted
        } elseif ($i) {
            echo " | ";
        }
        echo $link;
        $lastlink = $i;
    }

    if ($currentPage <= $lastlink) {
        // display 'Next' link
        echo " | <a href=\"?page=" . ($currentPage + 1) . "\">Next &raquo;</a>";
    }

    echo "</p>\n\n";
}

//Display table of non annotated sequences :
echo "<table class='lignesEspacees'>";
echo "<tbody><br>";
echo "<tr>
            <td> Sequence Id </td>
            <td> Email choice </td>
           <td> Confirm assignment</td></tr>";
foreach ($non_annotated_results as $sequence) {
    if (isset($_POST["submit_".$sequence])) {
        $annotator_assigned = $_POST["annotator_" . $sequence];
        $assign_update = pg_query_params($db_conn, $assign_query, array($annotator_assigned, $sequence)) or die(pg_last_error());
        echo "This ".$sequence." was successfully assigned to ".$annotator_assigned;
    } else {
        echo "<tr>
            <td>" . $sequence . "</td>
            <td><select name='annotator_" . $sequence . "'>";
        foreach ($annotator_results as $annotator) {
            echo "<option value='" . $annotator . "'>" . $annotator . "</option>";
        }
        echo "</select></td>
            <td><button class='btn btn--assign' name='submit_" . $sequence . "' type='submit'> Assign </button></td>";
    }

}
echo "</tbody></table>";

disconnect_db();
?>
</body>
</html>