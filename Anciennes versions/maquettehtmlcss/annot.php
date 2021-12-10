<html>
<head>
    <title>Requêtes</title>
</head>
<body>
<?php
//Connexion aux bases de données postgresql
$servername ="localhost";
$username = "postgres";
$password="Think13";
$dbname="gene";

//try, catch pour vérifier que la connexion à postgresql est établie ou non
try{
    $conn = new PDO("pgsql: host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Fixe la base de données de travail
    $conn->exec('SET search_path TO gene');
    echo "la connexion a été bien etablie"; //essaye de se connecter à la base de données. Si elle fonctionne -> affiche ce message
    echo "<br />";

    //Requêtes + affichage des résultats
    $sql = "SELECT * FROM sequence WHERE accessionNb ='ASM1330v1'";
    $result = $conn->query($sql);
    while($row=$result->fetch()){
        echo $result;
        echo $row['accessionnb'].'-'.$row['species'].'-'.$row['strain'].'-'.$row['seq_length'].'-'.$row['seq_nt'].'<br/>';
    }
}

catch(PDOException $e){ //sinon utilise PDOException pour renvoyer un message d'erreur
    echo "la connexion a échoué:" . $e-> getMessage();
}
?>

</body>
</html>