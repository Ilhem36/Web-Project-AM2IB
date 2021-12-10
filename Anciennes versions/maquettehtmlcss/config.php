<?php
$host = "localhost";
$port = "5432";
$dbname = "web_gene";
$user = "postgres";
$password = "Think13";
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
?>
