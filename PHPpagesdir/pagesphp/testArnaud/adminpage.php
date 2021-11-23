<!DOCTYPE html>
<style type="text/css">
    *{
        margin:0;
        padding:0;
        box-sizing: border-box;
    }
    body{
        background-color:darkmagenta;
        font-family: sans-serif;
    }
    .table-container{
        padding: 0 10%;
        margin: 40px auto 0;
    }
    .heading{
        font: size 40px;
        text-align: center;
        color:white;
        margin-bottom: 40px;
    }
    .table{
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
            background-color: white;
    }
    .table thead tr th {
        font-size: 14px;
        font-weight: medium;
        letter-spacing: 0.35px;
        color: black;
        opacity: 1;
        padding: 12px;
        vertical-align: top;
        border: 1px solid black;
    }
    .table tbody tr td{
        font-size: 14px;
        letter-spacing: 0.35;
        font-weight: normal;
        color:black;
        background-color:white;
        padding: 8px;
        text-align: center;
        border: 1px solid black; 

    }
    .table .text_open{
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 0.35px;
        color: cornflowerblue;
    }
    .table .tbody tr td .btn{
        width: 130px;
        text-decoration: none;
        line-height: 35px;
        display: block;
        background-color: #FF1046 ;
    }
</style>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <div class="table-container">
        <h1 class="heading">Genome for annotation </h1>
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

        $result = mysqli_query($conn,"SELECT * FROM users");

        echo "<table border='1'>
            <tr>
           <th> First Name </th>
            <th> Family Name </th>
            <th> Role </th>
            <th> Email </th>
            <th> Phone Number  </th>
            <th> Date </th>
            <th> Hour </th>
            <th> Delete </th>
            <th> Affect role</th>

             </tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conn);
        ?>
    </div>
                    <tbody>
                </table><br> 
                <input type="button" value="Soumettre">
           
           <a href="ind.php" class ="button">logout</a>

        </div>
