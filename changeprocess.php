<?php
// PROCESS-CHANGE_MDP.PHP 
// Envoi de l'email pour le changement de mdp

// On inclut la page de connexion à la bdd
require('includes/connexion.php');

// Si les deux champs on été correctement remplis sur changer_mdp.php
if(isset($_POST['pseudo']) && isset($_POST['email'])) {
    // On stocke les $_POST dans des variables 
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    
    // On vérifie que l'email appartient au pseudo
    $checkemail = $db -> prepare('SELECT pseudo FROM membres WHERE email=?');
    $checkemail->execute(array('email' => $email);
    // On définit quelques variables
    $date = date('d-m-Y');
    $heure = date('H:i');
    
    // On génère un token
    $token = substr(md5(rand()), 0, 10);
    // On insert le token dans la bdd
    $insert_token = $db -> prepare('INSERT INTO membres (changepasskey) VALUES (:token)');
    $insert_token->execute(array('token' => $token));
    $insert_token->closeCursor();
    
    // On définit les parties du mail
    $destinataire = $email;
    $sujet = "Nether News - Activation de votre compte";
    $headers = 'MIME-Version: 1.0'."\r\n".
      'Content-type: text/html; charset=utf-8'."\r\n".
      'From: gweedzy@gmail.com'."\r\n".
      'X-Mailer: PHP/' . phpversion();
    $mail = "Vous avez demandé la réinitialisation du mot de passe de votre compte Nether News le $date à $heure. Cliquez sur ce lien ou copiez le dans votre barre de navigation : <a href='nouveaumdp.php' target='_blank'>http://notresite/nouveaumdp?pseudo=".urlencode($pseudo)."&token=".urlencode($token)."";
    
    // On envoie le mail
    mail($destinataire, $sujet, $message, $headers);
    
}
    
    