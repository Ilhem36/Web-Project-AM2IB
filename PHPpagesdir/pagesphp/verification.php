<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $servername ="localhost:3306";
    $username = "root";
    $password="root";
    $dbname="mysql";

   //try, catch vérifie que la connexion à mysql est établie
   try{
    $conn = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
}
catch(PDOException $e){
    echo "la connexion a échoué:" . $e-> getMessage();
}
    
    
    if($Email !== "" && $Password !== "")
    {
        $requete = "SELECT count(*) FROM testsql where 
              Email = '".$Email."' and Password = '".$Password."' ";
        $exec_requete = mysqli_query($conn,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['Email'] = $Email;
           header('Location: pageform.php');
        }
        else
        {
           header('Location: ind.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: ind.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: ind.php');
}
mysqli_close($db); // fermer la connexion
?>
