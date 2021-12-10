<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<!-- page annoter pour l'annotateur -->
<head>
  <title>Annotation form </title>
  <meta name="keywords" content="Annotation">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Annotation </h2>
    <?php require_once 'db_utils.php';
    connect_db();
    $email_annot = "annotateur@psud.fr"; /*$1*/
    $insert_annotation_query = "INSERT INTO w_gene.annotation(email_annot, date_annot, geneid, idsequence, genebiotype, transcriptbiotype, genesymbol, description, status) VALUES ($1,'now',$2,$3,$4,$5,$6,$7,0)";
    $update_sequence_query = "UPDATE w_gene.sequence SET annot=1 WHERE idsequence=$1";
    //ID sequence to display
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        echo "You have chosen ".$id;
    }else{
        echo "No sequence id given";
    }

    if(isset($_POST['submit'])){
        $gene_id = $_POST["gene_id"];
        $gene_biotype = $_POST["gene_biotype"];
        $transcript_biotype = $_POST["transcript_biotype"];
        $gene_symbol = $_POST["gene_symbol"];
        $description = $_POST["Description"];
        print_r($_POST);
//        $id = $_POST["idsequence"];
        if (empty($gene_symbol)){
            $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,null,$description)) or die(pg_last_error());
        } else {
            $insert_annotation = pg_query_params($db_conn,$insert_annotation_query,array($email_annot,$gene_id,$id,$gene_biotype,$transcript_biotype,$gene_symbol,$description)) or die(pg_last_error());
        }
        $update_sequence=pg_query_params($db_conn,$update_sequence_query,array($id)) or die(pg_last_error());
        echo "Your annotation was submitted successfully";
    }
    disconnect_db();
    ?>
  <form method="post" class="form-group"  action="<?php echo $_SERVER['PHP_SELF'] . '?'.http_build_query($_GET);?>">
    <input type="hidden" class="form-control" name = "idsequence" value="<?php echo strip_tags($_GET['id'])?>" disabled>
    <div class="form-group">
      <label for="gene_id">gene_id:</label>
      <input type="text" class="form-control" id="gene_id" placeholder="Enter the gene_id of the sequence " name="gene_id" required>
    </div>

    <div class="form-group">
      <label for="gene_biotype">gene_biotype:</label>
      <input type="text" class="form-control" id="gene_biotype" placeholder="Enter gene_biotype" name="gene_biotype" required>
    </div>

    <div class="form-group">
      <label for="transcript biotype">transcript_biotype:</label>
      <input type="text" class="form-control" id="transcript_biotype" placeholder="Enter transcript biotype" name="transcript_biotype" required>
    </div>

    <div class="form-group">
      <label for="gene_symbol">gene_symbol</label>
      <input type="text" class="form-control" id="gene_symbol" placeholder="Enter gene symbol" name="gene_symbol" required>
    </div>
    <div class="form-group">
      <label for="Description">Description</label>
      <textarea  class="form-control" id="Description" placeholder="Enter Description" name="Description"></textarea>
    </div>


    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>
</body>
</html>
