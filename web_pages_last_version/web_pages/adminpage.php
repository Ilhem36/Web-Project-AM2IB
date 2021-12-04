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
        <h1 class="heading">User list </h1>
        <?php require_once 'db_utils.php';
        connect_db();

        $result = pg_query($db_conn,"SELECT * FROM w_gene.users");
        echo "<form action='adminmodif.php' method='post'>";
            echo "<table class='table'>
                    <thead>
                        <tr>
                       <th> First Name </th>
                        <th> Family Name </th>
                        <th> Role </th>
                        <th> Email </th>
                        <th> Phone Number  </th>
                        <th> Date </th>
                        <th> Delete </th>
                        <th> Affect role</th>
                        </tr>
                    </thead>";
                $n=0;
                while($row = pg_fetch_array($result))
                {
                    $n++;
                    echo "<tr>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo"<td>","<input type='checkbox' name= 'delete_$n'>","</td>";
                    echo"<td>","<select name='role_$n'>",
                        "<option value= 'empty'> Choose role </option>",
                        "<option value= 'reader'>Reader</option>",
                        "<option value= 'annotator'>Annotator</option>",
                        "<option value= 'validator'>Validator</option>",
                        "</select>","</td>";
                    echo "</tr>";
                    $PK[$n] = $row['email'];
                }
                echo "</table>";
            echo "<input type='submit' name = 'submit' value='Soumettre'>";
        echo"</form>";
        disconnect_db();
        ?>
    </div>

    <a href="ind.php" class ="button">logout</a>

        </div>
</html>