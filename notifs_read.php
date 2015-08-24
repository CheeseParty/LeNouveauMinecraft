<?php
# NOTIFS_READ.PHP
# Met à jour le status des notifications de l'utilisateur

session_start();

# Vérification de l'utilisateur
if(!isset($_SESSION['AUTH'])) {
    exit;
}

# Si l'utilisateur est ok, on peut faire la requête
require('includes/connexion.php');
$update = $db -> prepare('UPDATE membres SET notifs=0 WHERE pseudo=?');
$update -> execute(array($_SESSION['AUTH']));

# Fermeture de la requête
$update -> closeCursor();