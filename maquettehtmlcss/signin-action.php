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

    //Retreive Data
    $username = $_GET['username'];
    $password = $_GET['password'];

    //Requêtes + affichage des résultats
    $sql = "SELECT DISTINCT email, name, role FROM gene.users WHERE surname = '{$username}' AND password = '{$password}';";
    try{
        $result = $conn->query($sql);
        foreach ($result as $res){
            if ($res['role'] == 'annotator'){
                header("Location: http://localhost:8090/WP/Web-Project-AM2IB-1/maquettehtmlcss/Annotatorpage.php?email={$res['email']}");
            }elseif ($res['role'] == 'Validator'){
                header("Location: http://localhost:8090/WP/Web-Project-AM2IB-1/maquettehtmlcss/Annotatorpage.php?email={$res['email']}");
            }
        }

    }catch(PDOException $e){
        echo "update has failed ". $e->getMessage();
    }


}

catch(PDOException $e){ //sinon utilise PDOException pour renvoyer un message d'erreur
    echo "la connexion a échoué:" . $e-> getMessage();
}