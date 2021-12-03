<?php
// php code for assign_annot page
require_once 'db_utils.php';
connect_db();
/*pagination avec https://www.the-art-of-web.com/php/pagination/*/
//Page
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int)strip_tags($_GET['page']);
} else { /*no page number is defined*/
    $currentPage = 1;
}
$perpage = 20; /*Number of results per page*/
$precedent = ($currentPage - 1) * $perpage;

//Liste annotateurs
$annotator_query = "SELECT email FROM w_gene.Users WHERE role in ('annotator','validator','admin')";
$annotator_results = pg_query($db_conn, $annotator_query) or die(pg_last_error());
$annotator_results = pg_fetch_all_columns($annotator_results);/*une liste  des annotateurs */

//Liste sequence non annotees
$non_annotated_query = "SELECT idsequence FROM w_gene.Sequence WHERE annot=0 LIMIT $1 OFFSET $2";
$non_annotated_results = pg_query_params($db_conn, $non_annotated_query, array($perpage, $precedent)) or die(pg_last_error());
$non_annotated_results = pg_fetch_all_columns($non_annotated_results);
//Nombre de resultats pour pagination
$nr_results_query = "SELECT idsequence FROM w_gene.sequence WHERE annot=0";
$nr_results_result = pg_query($db_conn, $nr_results_query);
$nr_results_result = pg_num_rows($nr_results_result);

// Assignement sequence annotateur $1 annotateur selectionne et $2 sequence assignee
$assign_query = "UPDATE w_gene.sequence SET annot=2, Email_annot=$1 WHERE idSequence=$2";


//Pagination
// build array containing links to all pages
$tmp = [];
for ($p = 1, $i = 0; $i < $nr_results_result; $p++, $i += $perpage) {
    if ($currentPage == $p) {
        // current page shown as bold, no link
        $tmp[] = "<b>" . $p . "</b>";
    } else {
        $tmp[] = "<a href=\"?page=" . $p . "\">" . $p . "</a>";
    }
}

// thin out the links
for ($i = count($tmp) - 3; $i > 1; $i--) {
    if (abs($currentPage - $i - 1) > 2) {
        unset($tmp[$i]);
    }
}

// display page navigation if data covers more than one page
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

//affichage tableau des sequences a annoter
echo "<table>";
echo "<thead><th><th colspan='2'> Assign sequence to annotator </th></thead>";
echo "<tbody>";
echo "<tr>
            <td>Id Sequence</td>
            <td>Annotator email</td>
            <td>Confirm assignment</td></tr>";
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
            <td><button name='submit_" . $sequence . "' type='submit'>Assign</button></td>";
    }

}
echo "</tbody></table>";

disconnect_db();
?>
