<?php
//This page in linked to valid_annot.php. It is dedicated for validators to manage annotations(Reject/Accept)
//Connection to database
require_once 'db_utils.php';
connect_db();
session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Annotator space </title>
    <link rel="stylesheet" href="annot_seq.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="logo">
                <a href="#">GenAnnot.</a>
            </div>
            <ul class="nav-links">
                <!-- display the bar navigation -->
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
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <table class="table">
            <thead>
            <tr>
                <th>Annotation</th>
                <th>Gene ID</th>
                <th>Gene and transcript biotype</th>
                <th>Gene symbol</th>
                <th>Description</th>
                <th>Validation</th>
                <th>Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php require_once 'valid_annot.php' ?>
            </tbody>
        </table>

</form>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>