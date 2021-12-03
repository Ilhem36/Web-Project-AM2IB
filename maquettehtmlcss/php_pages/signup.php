<!DOCTYPE html>
<!-- set the language and the direction of the text-->
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
          Sign Up
        </title>
        <!--link for css file -->
        <link rel="stylesheet" type="text/css" href="signin.css">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="title"> Sign up </div><br>
        <?php
        require_once 'db_utils.php';
        connect_db();
        #conditions vides, majuscules debut+correction sql, tej ligne egal
        //Quand on clique sur submit
        //récupère les valeurs dans les champs définis, et les insère dans la base de données sql
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirm_password= $_POST['confirm_password'];
            $role = $_POST['role'];
            if ($password != $confirm_password) {
                header('Location:signup.php?Error=1');
            } else {
                $sql_Query = "SELECT * FROM w_gene.users WHERE email='" .$_POST["email"]. "'";
                $result = pg_query($db_conn, $sql_Query);
                if (pg_num_rows($result) != 0) {
                    header('Location:signup.php?error=1');
                } else {
                    $sqlQuery = "INSERT INTO w_gene.users(name, surname, email,phone, password,role) VALUES ('" . $name . "','" . $surname . "', '" . $email . "', '" . $phone . "', '" . $password . "','" . $role . "')";
                    $result= pg_query($db_conn, $sqlQuery) or die(pg_last_error());
                    echo "Your registration has been successfully registred. Please wait for confirmation";
                }
            }
        }
        disconnect_db();
        ?>
        <form action="signup.php" method="post">
            <div class="user-details">
                <div class = "input-box">
                    <span class="details">Name</span>
                    <input type="text" name = "name" placeholder="Enter your name" required>
                </div>
                <div class = "input-box">
                    <span class="details">Family name</span>
                    <input type="text" name = "surname" placeholder="Enter your Family name " required>
                </div>
                <div class = "input-box">
                    <span class="details">Email</span>
                    <input type="text" name = "email" placeholder="Enter your Email" required>
                </div>
                <div class = "input-box">
                    <span class="details">Phone Number </span>
                    <input type="text" name = "phone" placeholder="Enter your Number" required>
                </div>
                <div class = "input-box">
                    <span class="details">Password</span>
                    <input type="text" name = "password" placeholder="Enter your password" required>
                </div>
                <div class = "input-box">
                    <span class="details">Confirm your password</span>
                    <input type="text" name = "confirm_password" placeholder="Enter your password" required>
                </div>
            </div>
            <div class= "input-box">
                <span class="details">Choose your role</span>
            <select name="role">
                <option value= "reader">Reader</option>
                <option value= "annotator">Annotator</option>
                <option value= "validator">Validator</option>
             </select> <br>
            </div> <br>
                <div class="button">
                    <input type="submit" name = "submit" value="Register">
                </div>


        </form>
    </div> 
</body>
</html>



