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
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="adminpage2.php">Admin</a></li>
            <li><a href="assign_annot.php">Validator</a></li>
            <li><a href="annot_seq.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a>
                <ul class="sous-menu">
                    <li class = "sous-menu1"><a href="#">Form</a></li>
                    <ul class="sous-sous-menu">
                        <li class="sous-menu2"><a href="Form_genome.php">Genomes Form</a></li>
                        <li class="sous-menu2"><a href="Form_cds.php">Genes/Prot Form</a></li>
                        <!--TODO: sous menu apparait quand tu passes ta souris-->
                    </ul>
                </ul>
            </li>
            <li><a href="signIn.php">Logout</a>
        </ul>
    </div>
</nav>

<div class ="container">
<div class="title"> Admin page </div><br>
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
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['family_name'] . "</td>";
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
</body>
</html>