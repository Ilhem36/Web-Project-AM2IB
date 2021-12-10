<?php
//Connect to database.
require_once 'db_utils.php';
connect_db();
//Start session for the logins
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- This page is dedicated to display annotations being validated -->
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
            <!--Display the navigation bar for annotators-->
            <?php require_once 'Menu.php' ; ?>
            <br><br>
                <div class = "hello">
                    <!-- Welcome message for the user-->
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
        //Recover email from the login
        $user=$_SESSION["session_login"];
        //Select interested information about sequences being validated
        $consult_annot_query='SELECT  idsequence, date_annot, geneid, genebiotype,transcriptbiotype,genesymbol,description,status,comments FROM w_gene.annotation where status=0';
        $execute_query=pg_query($db_conn,$consult_annot_query)or die(pg_last_error());
        //Create table columns  which will contains the interested  informations
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
        // Store the interested  information in the table:

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
            // Specifiy the status of annotation and extract the comment:
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