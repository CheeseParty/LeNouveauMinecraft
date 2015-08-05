<?php
// REGFORM.PHP
// Processing du formulaire d'inscription
session_start();

// Vérification de la requête
$error = false;

function check($var) {
    if(!isset($var)) {
        $error = "empty";
        return false;
    } else {
        return true;
    }
}

if(check($_POST['pseudo'])) {
    if(!preg_match('#^[A-Za-z][A-Za-z0-9]{5,31}$#', $_POST['pseudo'])) {
        $error = "pseudo";
    }
}
check($_POST['password']);
check($_POST['password2']);
if(check($_POST['email'])) {
    if(!preg_match('#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$#', $_POST['email'])) {
        $error = "email";
    }
}
if($_POST['password'] != $_POST['password2']) {
    $error = "password";
}


// Si la requête est ok
if($error != false) {
    header("Location: login.php?error=$error");
    exit;
}

// Inclusion
require('includes/connexion.php');

// Vérification de l'email & du pseudo
$check = $db -> prepare('SELECT id FROM membres WHERE email=? or pseudo=?');
$check -> execute(array(
    $_POST['email'],
    $_POST['pseudo']
));

// S'ils existent déjà
if($check->rowCount() > 0) {
    // On redirige avec message d'erreur
    header("Location: login.php?error=exist");
    exit;
}

// Sinon on l'inscrit
else {
    $register = $db -> prepare('INSERT INTO membres (id, pseudo, password, email) VALUES (:id, :pseudo, :password, :email)');
    $register->execute(array(
        "id" => "",
        "pseudo" => $_POST['pseudo'],
        "password" => $_POST['password'],
        "email" => $_POST['email']
    ));
    $register->closeCursor();

    $_SESSION['AUTH'] = $_POST['pseudo'];

    //Et on redirige à l'accueil
    header("Location: index.php");
    exit;
}