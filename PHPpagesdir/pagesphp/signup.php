
<?php 
    //connexion to mysql database
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

    //Quand on clique sur submit
    //récupère les valeurs dans les champs définis, et les insère dans la base de données sql
    if(isset($_POST['submit']))
    {
        $Name = $_POST['Name'];
        $Fname = $_POST['Fname'];
        $Email = $_POST['Email'];
        $Pnumber = $_POST['Pnumber'];
        $Password = $_POST['Password'];
        $Role = $_POST['Role'];

        $sqlQuery = "INSERT INTO testsql(Name, Fname, Email,Pnumber, Password, Role) VALUES (:Name, :Fname, :Email, :Pnumber, :Password, :Role)";
        $insertNew = $conn->prepare($sqlQuery);
        
        $insertNew->bindParam(':Name', $Name); //name clé primaire 
        $insertNew->bindParam(':Fname', $Fname);
        $insertNew->bindParam(':Email', $Email);
        $insertNew->bindParam(':Pnumber', $Pnumber);
        $insertNew->bindParam(':Password', $Password);
        $insertNew->bindParam(':Role', $Role);

        $insertNew->execute();
    }
?>

<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
          Sign in
        </title>
        <!--link for css file -->
        <link rel="stylesheet" type="text/css" href="signin.css">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="title"> Sign up </div>
        <form action="signup.php" method="post">
            <div class="user-details">
                <div class = "input-box">
                    <span class="details">Name</span>
                    <input type="text" name = "Name" placeholder="Enter your name" required>
                </div>
                <div class = "input-box">
                    <span class="details">Family name</span>
                    <input type="text" name = "Fname" placeholder="Enter your Family name " required>
                </div>
                <div class = "input-box">
                    <span class="details">Email</span>
                    <input type="text" name = "Email" placeholder="Enter your Email" required>
                </div>
                <div class = "input-box">
                    <span class="details">Phone Number </span>
                    <input type="text" name = "Pnumber" placeholder="Enter your Number" required>
                </div>
                <div class = "input-box">
                    <span class="details">Password</span>
                    <input type="text" name = "Password" placeholder="Enter your password" required>
                </div>
        
            </div>
            <div class= "input-box">
                <span class="details">Choose your role</span>
            <select name="Role">
                <option value= "Reader">Reader</option>
                <option value= "Annotator">Annotator</option>
                <option value= "Validator">Validator</option>    
             </select> <br>
            </div> <br>
                <div class="button">
                    <input type="submit" name = "submit" value="Register">
                </div>
                
            
        </form>
    </div> 
</body>
</html>



