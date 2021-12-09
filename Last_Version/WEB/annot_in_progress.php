<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- HTML PAGE FOR VALIDATOR PAGE(valid_annot)-->
<head>
    <title>Annotation history </title>
    <link rel="stylesheet" href="annot_seq.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <?php require_once 'Menu.php' ; ?>
            <br><br>
                <div class = "hello">
                    <?php
                    echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                    ?>
                </div>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="title"> Annotations in the process of validation</div><br>
        <?php
        $validator =$_SESSION["session_login"];
        $consult_annot_query='SELECT  idsequence, date_annot, geneid, genebiotype,transcriptbiotype,genesymbol,description,status,comments FROM w_gene.annotation where status=0';
        $execute_query=pg_query($db_conn,$consult_annot_query)or die(pg_last_error());
        echo"<table class ='table'>
               <thead>
                  <tr>
                  <th> Id sequence</th>
                  <th> Annotation Date </th>
                  <th> Gene ID </th>
                  <th> Gene biotype </th>
                  <th> Transcript biotype </th>
                  <th> Gene Symbol </th>
                  <th> Description </th>
                  <th> Status </th>
                  <th> Comments </th>
                  </tr>
               </thead>";

        while ($annot=pg_fetch_assoc($execute_query)){
            echo"<tr>
                <td>" . $annot['idsequence'] . " </td>
                <td>" . $annot['date_annot'] . "</td>
                <td>" . $annot['geneid'] . "</td>
                <td>" . $annot['genebiotype'] . "</td>
                <td>" . $annot['transcriptbiotype'] . "</td>
                <td>" . $annot['genesymbol'] . "</td>
                <td>" . $annot['description'] . "</td>
                
                <td>";
            if ($annot['status']==2) {
                echo "<p>Rejected</p></td>";
            }else if($annot['status']==1) {
                echo "<p>Rejected</p></td>";
            }else {
                echo  "<p>Being validated</p></td>";
            }
            echo "<td>" . $annot['comments'] . "</td>
            </tr>";

        }
        echo "</table>";
        ?>
</div>

</body>
</html>