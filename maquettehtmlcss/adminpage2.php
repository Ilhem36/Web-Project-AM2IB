<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- HTML PAGE FOR VALIDATOR PAGE(valid_annot)-->
<head>
    <meta charset="UTF-8">
    <title>Admin space </title>
    <link rel="stylesheet" href="admin.css">

</head>
<body>
<nav>
    <div class="nav-content">
        <div class=logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Form</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
            <li><a href="#">Reader</a></li>
            <li><a href="signIn.php">Logout</a>

        </ul>
    </div>

</nav>
</body>
        <?php require_once 'db_utils.php';
        connect_db();

        $result = pg_query($db_conn,"SELECT * FROM w_gene.users");
        echo "<form action='adminmodif2.php' method='post'>";
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
                echo"<br>";
            echo "<input class ='btn btn--assign' type='submit' name = 'submit' value='Confirm' >";

        echo"</form>";

        disconnect_db();
        ?>

</div>
        </div>
</html>