<?php
session_start();
if(isset($_SESSION["session_login"])){// vérifie que le champ session_login: l'email n'est vide
    unset($_SESSION);// ???
    session_destroy();
    // il revient à la page de login
    header("Location:signIn.php");
}