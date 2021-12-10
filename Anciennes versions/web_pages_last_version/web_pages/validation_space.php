<html>
<!-- HTML PAGE FOR VALIDATOR PAGE(valid_annot)-->
<head>
    <title>Annotator space </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h4>Validation space</h4>
    <hr>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Annotation</th>
                <th>Gene ID</th>
                <th>Gene and transcript biotype</th>
                <th>Gene symbol</th>
                <th>Description</th>
                <th>Validation</th>
                <th>Comment</th>

<!--                commentaire + statut de validation-->
            </tr>
            </thead>
            <tbody>
            <?php require_once 'valid_annot.php' ?>
            </tbody>
        </table>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>