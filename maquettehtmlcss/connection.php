<?php
$servername ="localhost";
$username = "postgres";
$password="Think13";
$dbname="web_gene";

$conn = pg_pconnect("host=$servername dbname=$dbname  user=$username  password=$password");
if (!$conn) {
    echo "Please check your connection\n";
    exit;
}
?>
