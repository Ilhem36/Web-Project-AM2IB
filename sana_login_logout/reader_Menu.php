<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Reader page</title>
    <link rel="stylesheet" type="text/css" href="reader_menu.css">
</head>

<body>
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="#">GenAnnot.</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="#">Annotator</a></li>
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
            <li><a href="#">Logout</a>
                <!--signIn.php-->
        </ul>
    </div>
</nav>

<div class ="container">
    <p><h2> This is the Reader page ! </h2><br>
    <p>Click on the <strong>Form menu</strong> to access to the genomes and genes search form. </p><br>
    <p> You can search and read information about bacterial genomes, genes and peptides from the database. If needed, you can also download your search results pages.</p>
</div>

</body>
</html>
