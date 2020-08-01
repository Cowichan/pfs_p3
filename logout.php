<?php
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
echo "Vous etes déconnecté";

?>

<a href="index.php">Accueil</a>
