<!DOCTYPE html>
<html>
<!-- HTML PAGE FOR VALIDATOR PAGE(valid_annot)-->
<head>
    <title>Your annotation history </title>
    <link rel="stylesheet" href="annot_seq.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav>
    <div class="nav-content">
        <div class=logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Form</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
            <li><a href="#">Reader</a></li>
            <li><a href="signIn.php">Logout</a>
        </ul>
    </div>
</nav>
<div class="container">
    <table style="width: 100%">
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
                echo "<p>Rejected</p></td>";
            }else if($annot['status']==1) {
                echo "<p>Rejected</p></td>";
            }else {
                echo  "<p>Being validated</p></td>";
            }
            echo "<td>The comment: " . $annot['comments'] . "</td>
            </tr>";

        }
        ?>
    </table>
</div>

</body>
</html>