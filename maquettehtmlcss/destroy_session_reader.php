<?php
session_start();
if($_SESSION['session_login']){
    echo "Welcome to your space " .$_SESSION["session_login"];
}else{
    header("location:signIn.php");
}
?>
