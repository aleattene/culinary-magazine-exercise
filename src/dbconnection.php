
<?php

// dichiarazione VARIABILI per la CONNESSIONE al DB

$server = "";
$username = "";
$password = "";
$database = "";

// CONNESSIONE al DB 

$dbconnection = mysqli_connect($server, $username, $password, $database)
   or die("Impossibile Connettersi al Database");


?>