<?php
// LOGFORM.PHP
// Vérification du pseudo et du mdp
session_start();

// Si la requête est valide
if(isset($_POST['pseudo']) AND isset($_POST['password'])) {
    require('includes/connexion.php');

    $conn = $db->prepare('SELECT id, rank, hash FROM membres WHERE pseudo=? AND actif=1');
    $conn->execute(array($_POST['pseudo']));

    // Si la requête donne un résultat
    if($conn->rowCount() > 0) {
        while($data = $conn->fetch()) {
            // Et que le mot de passe est correct
            if(password_verify($_POST['password'],$data['hash'])) {
                $_SESSION['UID'] = $data['id'];
                $_SESSION['RANK'] = $data['rank'];
                $_SESSION['AUTH'] = $_POST['pseudo'];
                header("Location: index.php");
                exit;
            } else {
                header("Location: login.php?message=badlogin");
                exit;
            }
        }     
    }
    // Sinon
    else {
        header("Location: login.php?message=badlogin");
        exit;
    }
}
// Sinon
else {
    header("Location: login.php?message=empty");
    exit;
}