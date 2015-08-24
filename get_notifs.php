<?php
# GET_NOTIFS.PHP
# Retourne les notifications en JSON

session_start();

# Vérification de l'utilisateur
if(!isset($_SESSION['AUTH'])) {
    exit;
}

# Si l'utilisateur est ok, on peut faire la requête
require('includes/connexion.php');
$select = $db -> prepare('SELECT * FROM notifs WHERE pseudo=?');
$select -> execute(array($_SESSION['AUTH']));

# Si on a des notifications, on les met en JSON
if($select -> rowCount() > 0) {
    $json = $select -> fetchAll();
    echo json_encode($json);
}

# Fermeture de la requête
$select -> closeCursor();