<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--link for css file -->
    <link rel="stylesheet"  href="annot_seq.css">
</head>
<body>


<?php
// Validator page with Just php code
require_once 'db_utils.php';
connect_db();
$validator =$_SESSION["session_login"];
$to_validate_query = "SELECT annotid,  email_annot, geneid, idsequence, genebiotype, transcriptbiotype, genesymbol, description FROM w_gene.annotation where status=0";
$to_validate = pg_query($db_conn,$to_validate_query);

$update_annotation = "UPDATE w_gene.annotation SET comments=$1, status=$2 WHERE annotid=$3";

while ($validation=pg_fetch_assoc($to_validate)){
    if(isset($_POST['Validate_'.$validation['idsequence']])){
        $update = pg_query_params($db_conn,$update_annotation,array($_POST['Comment_'.$validation['idsequence']],1,$validation['annotid']));
        //il faut changer ça en annot id
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
disconnect_db();
?>
</body>
</html>