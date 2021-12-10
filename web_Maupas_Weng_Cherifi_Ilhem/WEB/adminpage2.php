<?php
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- HTML PAGE FOR VALIDATOR PAGE(valid_annot)-->
<head>
    <meta charset="UTF-8">
    <title>Admin space </title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
<!-- Menu Visualization   -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <?php require_once 'Menu.php' ; ?>

            <br><br>
            <div class = "hello">
                <?php
                echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                ?>
            </div>
        </ul>
    </div>
</nav>

<div class ="container">
    <div class="title"> Admin page </div><br>
    <?php require_once 'db_utils.php';
    connect_db();

    // Show the user table and create a form to delete or change roles
    $PK = [];
    $result = pg_query($db_conn,"SELECT * FROM w_gene.users ORDER BY email ASC");
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
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['family_name'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo"<td>","<input type='checkbox' name='delete_".$n."'>","</td>";
        echo"<td>","<select name='role[]'>",
        "<option value= 'empty'>Choose role </option>",
        "<option value= 'reader'>Reader</option>",
        "<option value= 'annotator'>Annotator</option>",
        "<option value= 'validator'>Validator</option>",
        "</select>","</td>";
        echo "</tr>";
        array_push($PK, $row['email']);
        $n++;
    }
    echo "</table>";
    echo"<br>";
    echo "<input id='submit' class ='btn btn--assign' type='submit' name = 'submit' value='Confirm' >";
    echo"</form>";

    disconnect_db();
    ?>
</div>

<!-- Refresh page to show the updates -->
<script>
    const inputDoc = document.getElementById("submit")
    inputDoc.onclick = () => {
        setTimeout(() => {

            window.location.reload()
        }, 500);
    }
</script>
</body>
</html>
