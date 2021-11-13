<!--Script test mysql + php + html, base de données fictive : -->
<!--Table User(IDuser {PK}, surname, name, age) -->
<!-- pour tester ce script, il faut créer cette table dans mysql via phpmyadmin et insérer des valeurs -->

<?php 
    //connexion to mysql database
    $servername ="localhost";
    $username = "root";
    $password="";
    $dbname="testsql";

    //try, catch vérifie que la connexion à mysql est établie
    try{
        $conn = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "la connexion a ete bien etablie";
    }
    catch(PDOException $e){
        echo "la connexion a échoué:" . $e-> getMessage();
    }

    //Quand on clique sur submit
    //récupère les valeurs dans les champs définis, et les insère dans la base de données sql
    if(isset($_POST['submit']))
    {
        $IDuser = $_POST['IDuser'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $age = $_POST['age'];

        $sqlQuery = "INSERT INTO user(IDuser, surname, name, age) VALUES (:IDuser, :surname, :name, :age)";
        $insertNew = $conn->prepare($sqlQuery);
        
        $insertNew->bindParam(':IDuser', $IDuser); //IDuser clé primaire autoincrémentable, peut-être qu'il ne faut pas l'afficher car elle se remplit toute seule
        $insertNew->bindParam(':surname', $surname);
        $insertNew->bindParam(':name', $name);
        $insertNew->bindParam(':age', $age);

        $insertNew->execute();
    }
?>


<!DOCTYPE html>

	<head>
		<meta charset="utf-8">
		<title>Users </title>
	</head>
	<body>
        <div class="container">
            <div class="title"> Fill out this Form: </div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
                    <div class= "User">
                        <br>
                        <div class = "input-box">
                            <span class="details">ID user</span>
                            <input type="text" name = "IDuser" placeholder="Enter the ID user" required>
                        </div><br>
                        <div class = "input-box">
                            <span class="details">surname</span>
                            <input type="text" name = "surname" placeholder="Enter the surname" required>
                        </div><br>
                        <div class = "input-box">
                            <span class="details">name</span>
                            <input type="text" name = "name" placeholder="Enter the name" required>
                        </div><br>
                        <div class = "input-box">
                            <span class="details">Age</span>
                            <select name="age">
                                <option value= "17">17</option>
                                <option value= "18">18</option>
                                <option value= "19">19</option>
                            </select> <br>
                        </div><br>
                    <div class="button">
                        <input type="submit" name="submit" value="Submit">
                    </div><br>
                    </div><br>
                </form>
        </div>
        
	</body>
