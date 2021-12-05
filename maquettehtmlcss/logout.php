<?php
session_start();
if(isset($_SESSION["session_login"])){// vérifie que le champ session_login: l'email n'est vide// ???
    session_destroy();
    unset($_SESSION ["session_login"]);
    header("Cache-Control: no-store, no-cache, must-revalidate");
    // il revient à la page de login
    header("Location:signIn.php");
    exit;
}