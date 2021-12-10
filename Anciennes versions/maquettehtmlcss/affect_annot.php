<?php
        //Connexion aux bases de données postgresql
         $servername ="localhost";
         $username = "postgres";
         $password="Think13";
         $dbname="web_gene";

        //try, catch pour vérifier que la connexion à postgresql est établie ou non
        try{
            $conn = new PDO("pgsql: host=$servername; dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Fixe la base de données de travail
            $conn->exec('SET search_path TO gene');
            echo "la connexion a été bien etablie"; //essaye de se connecter à la base de données. Si elle fonctionne -> affiche ce message
            echo "<br />";

            //Retreive Data
            $email_annot = $_POST['annotEmail'];
            $idSeq = $_POST['seqId'];

            //Requêtes + affichage des résultats
            $sql = "UPDATE web_gene.annotation SET email_annot = '{$email_annot}'  WHERE idsequence = '{$idSeq}' ;";
            try{
                $result = $conn->query($sql);
            }catch(PDOException $e){
                echo "update has failed ". $e->getMessage();
            }


        }

        catch(PDOException $e){ //sinon utilise PDOException pour renvoyer un message d'erreur
            echo "la connexion a échoué:" . $e-> getMessage();
        }


