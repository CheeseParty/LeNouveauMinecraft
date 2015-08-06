<?php 
// VALIDATION.PHP
// Page sur laquelle la validation va se terminer (lien envoyé par mail)

require('includes/connexion.php');

// On récupère les données dans l'url (pseudo de l'utilisateur et clé de validation)
$pseudo = $_GET['pseudo'];  
$cle = $_GET['cle'];

// On met à jour la variable actif de l'utilisateur qui vient de valider son compte (actif passe de 0 à 1)
$activation = $db->prepare('UPDATE membres SET actif=1 WHERE pseudo=:pseudo AND token=:token');
$activation->execute(array(
        'pseudo' => $pseudo,
        'token' => $cle
));

// Si un compte a été activé
if($activation->rowCount() > 0) {
    // On redirige vers la page qui affiche que le compte a été validé avec succès
    header('Location:validation_inscription.php');
} 

// Sinon
else {
    // On redirige vers la page de validation mais avec un $_GET['error'] donc un message d'erreur est affiché
    header('Location:validation_inscription.php?error=true');
}

// On ferme la requête       
$activation->closeCursor();

