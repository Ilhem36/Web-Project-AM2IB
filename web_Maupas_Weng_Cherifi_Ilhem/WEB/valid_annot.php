<!DOCTYPE html>
<!-- This page is dedicated for validators to valid or rejects annotations. It is linked to validation_space.php -->
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="annot_seq.css">
</head>
<body>


<?php
// Connection to database
require_once 'db_utils.php';
connect_db();
// Retreive validator email from the login
$validator =$_SESSION["session_login"];
//Select annotations from annotation table
$to_validate_query = "SELECT annotid,  email_annot, geneid, idsequence, genebiotype, transcriptbiotype, genesymbol, description FROM w_gene.annotation where status=0";
$to_validate = pg_query($db_conn,$to_validate_query);
//Query to update the status of annotation from being validated(0) to validated(1) or rejected(2)
$update_annotation = "UPDATE w_gene.annotation SET comments=$1, status=$2 WHERE annotid=$3";
while ($validation=pg_fetch_assoc($to_validate)){
    if(isset($_POST['Validate_'.$validation['idsequence']])){
        $update = pg_query_params($db_conn,$update_annotation,array($_POST['Comment_'.$validation['idsequence']],1,$validation['annotid']));
        echo "The sequence ".$validation['idsequence']." was validated";
    } elseif (isset($_POST['Reject_'.$validation['idsequence']])){
        $update = pg_query_params($db_conn,$update_annotation,array($_POST['Comment_'.$validation['idsequence']],2,$validation['annotid']));
        echo "The sequence ".$validation['idsequence']." was rejected";
    } else {
        echo "<tr>
                <td>" . $validation['idsequence'] . " done by " . $validation['email_annot'] . "</td>
                <td>" . $validation['geneid'] . "</td>
                <td>Gene : " . $validation['genebiotype'] . "<br>
                 Transcript: " . $validation['transcriptbiotype'] . "</td>
                <td>" . $validation['genesymbol'] . "</td>
                <td>" . $validation['description'] . "</td>
                <td><input type='submit' name='Validate_" . $validation['idsequence'] . "' class='btn btn--assign' value='Validate'><br><br>
                    <input type='submit' name='Reject_" . $validation['idsequence'] . "' class='btn btn--assign' value='Reject'></td>
                <td><textarea  name='Comment_" . $validation['idsequence'] . "' class='form-control' placeholder='Write your comment here...'></textarea></td>
            </tr>";
    }
}
?>
</body>
</html>
<?php   disconnect_db(); //deconnexion from the database ?>