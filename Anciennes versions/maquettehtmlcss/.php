<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Pagination in Php With Next and Previous</title>
</head>
<body>
<table class="table table-striped">
    <tr>
        <td> User ID </td>
        <td> User Name </td>
        <td> User Email </td>
    </tr>
    <tr>
        <?php
        while($row=mysqli_fetch_assoc($result))
        {
        ?>
        <td> <?php echo $row['ID'] ?> </td>
        <td> <?php echo $row['UserName'] ?> </td>
        <td> <?php echo $row['Email'] ?> </td>

    </tr>
    <?php
    }
    ?>
</table>

<?php
require_once('connection.php');
$pr_query = "select * from pagination ";
$pr_result = mysqli_query($conn,$pr_query);
$total_record = mysqli_num_rows($pr_result );

$total_page = ceil($total_record/$num_per_page);

if($page>1)
{
    echo "<a href='validation_space.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
}


for($i=1;$i<$total_page;$i++)
{
    echo "<a href='validation_space.php?page=".$i."' class='btn btn-primary'>$i</a>";
}

if($i>$page)
{
    echo "<a href='validation_space.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
}

?>


</body>
</html>
