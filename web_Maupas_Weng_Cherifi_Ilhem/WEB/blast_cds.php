<!DOCTYPE html>
<html lang="en" dir="ltr">
<!--This is the blastn function page, it prepare the multiple alignment query with the protein sequence in input. We access to this page from results_genome.php page by clicking on the button blastn-->
<head>
    <meta charset="utf-8" />
    <title>Blastn alignment (genes) </title>
</head>

<body>
<?php
//Get the sequence value from the form in results_cds.php
  if (!empty($_GET["gene_seq"])){
    $gene_seq = $_GET["gene_seq"];
    $gene_seq = $gene_seq.'';
    $type = "nuc"; //specify the type gene (nuc = nucleotide)
  }
?>
<?php
//Source code from https://github.com/AshokHub/BLASTphp/blob/master/blastphp.php?fbclid=IwAR2wQ_wt5ik8w4CB7AHrBN1Uk2p5y1nHbrupIWBNya3sLf0KDy4TFtHT9Jk
# $ID: blastphp.php, v 1.0 2017/02/21 21:02:21 Ashok Kumar T. $
#
# ===========================================================================
#
# This code is for example purposes only.
#
# Please refer to https://ncbi.github.io/blast-cloud/dev/api.html
# for a complete list of allowed parameters.
#
# Please do not submit or retrieve more than one request every two seconds.
#
# Results will be kept at NCBI for 24 hours. For best batch performance,
# we recommend that you submit requests after 2000 EST (0100 GMT) and
# retrieve results before 0500 EST (1000 GMT).
#
# ===========================================================================
#
# return codes:
#     0 - success
#     1 - invalid arguments
#     2 - no hits found
#     3 - rid expired
#     4 - search failed
#     5 - unknown error
#
# ===========================================================================

//Prepare the blastn request
if ($type == "nuc") {
    $encoded_query = urlencode($gene_seq);
    $base = 'nt'; //blastp versus nt (nucleotide collection)
    $blast_programm = 'blastn';
}

// Build the request
$data = array('CMD' => 'Put', 'PROGRAM' => $blast_programm, 'DATABASE' => $base, 'QUERY' => $encoded_query);
$options = array(
  'http' => array(
    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    'method'  => 'POST',
    'content' => http_build_query($data)
  )
);
$context  = stream_context_create($options);

// Get the response from BLAST
$result = file_get_contents("https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi", false, $context);

// Parse out the request ID
preg_match("/^.*RID = .*\$/m", $result, $ridm);
$rid = implode("\n", $ridm);
$rid = preg_replace('/\s+/', '', $rid);
$rid = str_replace("RID=", "", $rid);

// Parse out the estimated time to completion
preg_match("/^.*RTOE = .*\$/m", $result, $rtoem);
$rtoe = implode("\n", $rtoem);
$rtoe = preg_replace('/\s+/', '', $rtoe);
$rtoe = str_replace("RTOE=", "", $rtoe);



//converting string to long (sleep() expects a long)
$rtoe = $rtoe + 0;

// Maximum execution time of webserver (optional)
ini_set('max_execution_time', $rtoe+60);

// Wait for search to complete
sleep($rtoe);

// Poll for results
while(true) {
  sleep(10);

  $opts = array(
  	'http' => array(
      'method' => 'GET'
  	)
  );
  $contxt = stream_context_create($opts);
  $reslt = file_get_contents("https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_OBJECT=SearchInfo&RID=$rid", false, $contxt);

  if(preg_match('/Status=WAITING/', $reslt)) {
  	 //print "Searching...\n";
    continue;
  }

  if(preg_match('/Status=FAILED/', $reslt)) {
    print "Search $rid failed, please report to blast-help\@ncbi.nlm.nih.gov.\n";
    exit(4);
  }

  if(preg_match('/Status=UNKNOWN/', $reslt)) {
    print "Search $rid expired.\n";
    exit(3);
  }

  if(preg_match('/Status=READY/', $reslt)) {
    if(preg_match('/ThereAreHits=yes/', $reslt)) {
      //print "Search complete, retrieving results...\n";
      break;
  	} else {
      print "No hits found.\n";
      exit(2);
  	}
  }

  // If we get here, something unexpected happened.
  exit(5);
} // End poll loop

// Retrieve and display results
$opt = array(
  'http' => array(
  	'method' => 'GET'
  )
);
$content = stream_context_create($opt);
$output = file_get_contents("https://blast.ncbi.nlm.nih.gov/blast/Blast.cgi?CMD=Get&FORMAT_TYPE=Text&RID=$rid", false, $content);
print $output;
?>
</body>
</html>
