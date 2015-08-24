<?php
# CHECK_NOTIF.PHP
# Si l'utilisateur possède des notifications qu'il n'a pas lues, retourne true en AJAX

session_start();

# Vérification de l'utilisateur
if(!isset($_SESSION['AUTH'])) {
    exit;
}

# Si l'utilisateur est ok, on peut faire la requête
require('includes/connexion.php');
$select = $db -> prepare('SELECT notifs FROM membres WHERE pseudo=?');
$select -> execute(array($_SESSION['AUTH']));
$data = $select -> fetchAll();

# Si l'utilisateur possède des notifications non-lues
if($data[0]['notifs'] == 1) {
    echo true;
}

# Sinon
else {
    echo false;
}

# Fermeture de la requête
$select -> closeCursor();