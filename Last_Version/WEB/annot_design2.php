<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- This page contains the form to annotate sequences by annotators  -->
<head>
  <title>Annotation form </title>
  <meta name="keywords" content="Annotation">
  <link rel="stylesheet" href="reader.css">
</head>
<body>

<!-- Menu de navigation -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <a href="Home_page.php">GenAnnot.</a>
        </div>

        <ul class="nav-links">
            <li><a href="Home_page.php">Home</a></li>
            <li><a href="annot_in_progress.php">Annotations</a></li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">Validator</a></li>
            <li><a href="Annot_Menu.php">Annotator</a></li>
            <li><a href="reader_Menu.php">Reader</a></li>
            <li><a href="signIn.php">Logout</a><br><br>

                <div class = "hello">
                    <!--Connexion to database-->
                    <?php require_once 'db_utils.php';
                    connect_db();
                    // Start the session of the annotator:
                    session_start();
                    //Welcome message:
                    echo "Welcome <strong>".$_SESSION["session_login"]."</strong>";
                    ?>
                </div>

        </ul>
    </div>
</nav>

<div class ="container">
    <div class="title"> Add new annotations </div><br>
    <?php
    // Retrieve the annotator's email from the login
    $email_annot = $_SESSION["session_login"];
    //Query to insert annotation in annotation table from  the form completed by the annotator
    $insert_annotation_query = "INSERT INTO w_gene.annotation(email_annot, date_annot, geneid, idsequence, genebiotype, transcriptbiotype, genesymbol, description, status) VALUES ($1,'now',$2,$3,$4,$5,$6,$7,0)";
    //Update variable Annot  in database from non annotated  to annotated (so from 0 to 1)
    $update_sequence_query = "UPDATE w_gene.sequence SET annot=1 WHERE idsequence=$1";
    //Display the ID sequence which was chosen by the annotator in annot_seq page
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        //strip_tags attempts to return the ID after removing all null bytes, PHP and HTML tags from the code.
        $id = strip_tags($_GET['id']);
        echo "You have chosen ".$id;
        echo "<br>";
    }else{
        echo "No sequence id given";
    }
        //Retrieve the inputs of an annotation form
    if(isset($_POST['submit'])){
        $gene_id = $_POST["gene_id"];
        $gene_biotype = $_POST["gene_biotype"];
        $transcript_biotype = $_POST["transcript_biotype"];
        $gene_symbol = $_POST["gene_symbol"];
        $description = $_POST["Description"];
        // check if the annotator has filled in the gene_symbol field and execute insert_annotation_query query
        if (empty($gene_symbol)){
            $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,null,$description)) or die(pg_last_error());
        } else {
            $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,$gene_symbol,$description)) or die(pg_last_error());
        }
        //Update  table sequence
        $update_sequence=pg_query_params($db_conn,$update_sequence_query,array($id)) or die(pg_last_error());
        echo "Your annotation was submitted successfully";
    }
    disconnect_db();
    ?>
    <!--This is the form to be filled by annotator:-->
    <!--For information: http_build_query: Generates a URL-encoded query string from the associative (or indexed) array provided.-->
  <form method="post" class="form-group"  action="<?php echo $_SERVER['PHP_SELF'] . '?'.http_build_query($_GET);?>">
    <input type="hidden" class="form-control" name = "idsequence" value="<?php echo strip_tags($_GET['id'])?>" disabled>
      <!--This php is for ths historique page-->
      <a href="historique.php?id=<?php echo $id?>">History</a><br>
      <div class="form-details">
          <div class = "input-box">

              <strong>Gene ID : </strong>
              <input type="text" class="form-control" id="gene_id" placeholder="Enter the gene_id of the sequence " name="gene_id" required><br>
              <br>

              <strong>Gene biotype : </strong>
              <input type="text" class="form-control" id="gene_biotype" placeholder="Enter gene_biotype" name="gene_biotype" required><br>
              <br>

              <strong>Transcript biotype : </strong>
              <input type="text" class="form-control" id="transcript_biotype" placeholder="Enter transcript biotype" name="transcript_biotype" required><br>
              <br>

              <strong>Gene symbol : </strong>
              <input type="text" class="form-control" id="gene_symbol" placeholder="Enter gene symbol" name="gene_symbol" required>


              <strong>Description : </strong>
              <textarea  class="form-control" id="Description" placeholder="Enter Description" name="Description"></textarea>

              <div class="button">
                  <input type="submit" name="submit" value="Submit">
              </div>
          </div>
      </div>
  </form>
</div>
</body>
</html>