<?php
// REGFORM.PHP
// Processing du formulaire d'inscription
session_start();

// Vérification de la requête
$message = false;

function check($var) {
    if(!isset($var)) {
        $message = "empty";
        return false;
    } else {
        return true;
    }
}

if(check($_POST['pseudo'])) {
    if(!preg_match('#^[A-Za-z][A-Za-z0-9]{5,31}$#', $_POST['pseudo'])) {
        $message = "pseudo";
    }
}
check($_POST['password']);
check($_POST['password2']);
if(check($_POST['email'])) {
    if(!preg_match('#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$#', $_POST['email'])) {
        $message = "email";
    }
}
if($_POST['password'] != $_POST['password2']) {
    $message = "password";
}

// Vérification du reCAPTCHA
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => '6LcW5AoTAAAAAH3AbWHAfIxp_MkVnAoOm6cLVwa4', 'response' => $_POST['g-recaptcha-response']);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = utf8_encode(file_get_contents($url, false, $context));
$json = json_decode($result,true);
if($json['success'] != "true") {
    $message = "captcha";
}
var_dump($result);

// Si la requête est ok
if($message != false) {
    header("Location: login.php?message=$message");
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
    header("Location: login.php?message=exist");
    exit;
}

// Sinon on l'inscrit
else {
    $register = $db -> prepare('INSERT INTO membres (id, pseudo, hash, email) VALUES (:id, :pseudo, :hash, :email)');
    $register->execute(array(
        "id" => "",
        "pseudo" => $_POST['pseudo'],
        "hash" => password_hash($_POST['password'], CRYPT_BLOWFISH),
        "email" => $_POST['email']
    ));
    $register->closeCursor();

    //Et on redirige
    header("Location: login.php?message=sent");
    exit;
}