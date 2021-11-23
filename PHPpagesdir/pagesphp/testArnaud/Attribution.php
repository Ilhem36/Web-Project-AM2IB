<?php 
    //connexion to mysql database
    $servername ="localhost:3306";
    $username = "root";
    $password="root";
    $dbname="projetweb";

    //try, catch vérifie que la connexion à mysql est établie
    try{
        $conn = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
    }
    catch(PDOException $e){
        echo "la connexion a échoué:" . $e-> getMessage();
    }


    //Quand on clique sur submit
    //récupère les valeurs dans les champs définis, et les insère dans la base de données sql
    if(isset($_POST['Soumettre']))
    {
        $AnnotID = $_POST['AnnotID'];

        $sqlQuery = "INSERT INTO annot(AnnotID) VALUES (:AnnotID)";
        $insertNew = $conn->prepare($sqlQuery);
        
        $insertNew->bindParam(':AnnotID', $AnnotID); 

        $insertNew->execute();
    }
    header('Location: Validatorpage.php'); 
?>