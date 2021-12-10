<?php 

    //connexion to mysql database
    $servername ="localhost";
    $username = "root";
    $password="";
    $dbname="genedb";

    //try, catch vérifie que la connexion à mysql est établie
    try{
        $conn = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "la connexion a ete bien etablie";
    }
    catch(PDOException $e){
        echo "la connexion a échoué:" . $e-> getMessage();
    }

    if(isset($_POST['submit']))
    {
        $id_annot = $_POST['id_annot'];
        $email_annot = $_POST['email_annot'];
        $date_annot = $_POST['date_annot'];
        $id_gene = $_POST['id_gene'];
        $gene_biotype = $_POST['gene_biotype'];
        $transcript_biotype = $_POST['transcript_biotype'];
        $gene_symbol = $_POST['gene_symbol'];
        $description = $_POST['description'];
        $brin = $_POST['brin'];

        $sqlQuery = "INSERT INTO annotation(id_annot, email_annot, date_annot, id_gene, gene_biotype, transcript_biotype, gene_symbol, description, brin) VALUES (:id_annot, :email_annot, :date_annot, :id_gene, :gene_biotype, :transcript_biotype, :gene_symbol, :description, :brin)";
        $insertNew = $conn->prepare($sqlQuery);
        
        $insertNew->bindParam(':id_annot', $id_annot); 
        $insertNew->bindParam(':email_annot', $email_annot);
        $insertNew->bindParam(':date_annot', $date_annot);
        $insertNew->bindParam(':id_gene', $id_gene);
        $insertNew->bindParam(':gene_biotype', $gene_biotype); 
        $insertNew->bindParam(':transcript_biotype', $transcript_biotype);
        $insertNew->bindParam(':gene_symbol', $gene_symbol);
        $insertNew->bindParam(':description', $description);
        $insertNew->bindParam(':brin', $brin);

        $insertNew->execute();
    }
?> 

<!DOCTYPE html>

	<head>
		<meta charset="utf-8">
		<title>Gene Protein details </title>
		<link rel="stylesheet" type="text/css" href="">
        <link rel="stylesheet" type="text/css" href="signin.css">
	</head>
	<body>
        <div class="container">
            <div class="title"> Fill out this Form: </div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
                    <div class= "Gene proteine details">
                    <br>
			    
                    <div class = "input-box">
                            <span class="details">Annotation ID</span>
                            <input type="text" name = "id_annot" placeholder="Enter the annotation ID" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Email Annotator</span>
                        <input type="text" name = "email_annot" placeholder="Enter your email" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Annotation Date</span>
                        <input type="text" name = "date_annot" placeholder="Annotation Date" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Gene ID</span>
                        <input type="text" name = "id_gene" placeholder="Enter the Gene ID" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Gene Biotype</span>
                        <input type="text" name = "gene_biotype" placeholder="Enter the gene biotype" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Transcript Biotype</span>
                        <input type="text" name = "transcript_biotype" placeholder=" Enter the transcript biotype" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Gene Symbol</span>
                        <input type="text" name = "gene_symbol" placeholder="Enter the Gene Symbol" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Description</span>
                        <input type="text" name = "description" placeholder=" Enter the Description" required>
                    </div><br>
                    <div class = "input-box">
                        <span class="details">Strand</span>
                        <select name="brin">
                            <option value= "1">1</option>
                            <option value= "-1">-1</option>
                        </select> <br>
                    </div><br>
                    <div class="button">
                        <input type="submit" name="submit" value="Submit">
                    </div><br>
        
                    <a href="GeneProt.html">Gene Protein Form Results</a> <!--Le renvoi de la page vers la page results sera ensuite codé en php-->

                </form>
    </div>
        
	</body>
