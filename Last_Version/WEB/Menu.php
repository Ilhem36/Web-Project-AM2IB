<?php
if ($_SESSION['statut'] == 'admin') {
    echo '<li><a href="adminpage2.php">Admin</a></li>
                <li><a href="Validator_Menu.php">Validator</a></li>
                <li><a href="Annot_Menu.php">Annotator</a></li>
                <li><a href="reader_Menu.php">Reader</a></li>
                <li><a href="signIn.php">Logout</a>
               
                ';
    } else if ($_SESSION['statut'] == 'Validator') {
    echo '<li><a href="Validator_Menu.php">Validator</a></li>
            <li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a></li>
            <li><a href="signIn.php">Logout</a>  
          ';
    } else if  ($_SESSION['statut'] == 'annotator'){
    echo '<li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a></li>
            <li><a href="signIn.php">Logout</a>
            
            ';
    }else {
   echo'<li><a href="reader_Menu.php">Reader</a></li>
            <li><a href="signIn.php">Logout</a>
            ';

}
?>
