<?php
// LOGFORM.PHP
// Vérification du pseudo et du mdp
session_start();

if(isset($_POST['pseudo']) AND isset($_POST['password'])) {
    require('includes/connexion.php');
    $conn = $db->prepare("SELECT id FROM membres WHERE pseudo=? AND password=?");
    $conn->execute(array($_POST['pseudo'], $_POST['password']));

    if($conn->rowCount() > 0) {
        $_SESSION['AUTH'] = $_POST['pseudo'];
        header("Location: index.php");
        exit;
    }

    else {
        header("Location: login.php?message=badlogin");
        exit;
    }
}