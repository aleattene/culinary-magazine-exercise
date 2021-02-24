

<?php

session_start();

$_SESSION = array();         // eliminazione variabili di sessione impostate

session_unset();

session_destroy();           // eliminazione della sessione

header("Location: ../index.html");

?>

