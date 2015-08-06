<?php 
// VALIDATION.PHP
// Page sur laquelle la validation va se terminer (lien envoyé par mail)

require('includes/connexion.php');

// On récupère les données dans l'url (pseudo de l'utilisateur et clé de validation)
$pseudo = $_GET['pseudo'];
$cle = $_GET['cle'];

// On met à jour la variable actif de l'utilisateur qui vient de valider son compte (actif passe de 0 à 1)
$activation = $db->prepare('UPDATE membres SET actif=1, token=NULL WHERE pseudo=? AND cle=?');
$activation->execute(array(
        'pseudo' => $_GET['pseudo'],
        'cle' => $_GET['cle']
        ));
    
if(rowCount() > 0) {
    header('Location:validation_inscription.php');
} else {
    header('Location:validation_inscription.php?error=true');
}
       
$activation->closeCursor();

