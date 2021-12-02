<?php
# Cette page et surtout pour la sécurité pour que l'utilisateur n('écrit pas l'url de la page pour pouvoir se loguer
session_start();
$_SESSION['Username']=$_POST['Username'];
$_SESSION['Password']=$_POST['Password'];
HEADER('Location:ind.php');
?>
