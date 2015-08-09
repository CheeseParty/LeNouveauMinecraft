<?php
// CHANGEPROCESS.PHP 
// Envoi de l'email pour le changement de mdp

// On inclut la page de connexion à la bdd
require('includes/connexion.php');

// Si les deux champs on été correctement remplis sur changer_mdp.php
if(isset($_POST['pseudo']) && isset($_POST['email'])) {
    // On stocke les $_POST dans des variables 
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    
    // On vérifie que l'email appartient au pseudo
    $checkemail = $db -> prepare('SELECT id FROM membres WHERE email=:email AND pseudo=:pseudo');
    $checkemail->execute(array(
        'email' => $email,
        'pseudo' => $pseudo
    ));
    
    if($checkemail->rowCount() > 0) {
        // On définit quelques variables
        $date = date('d-m-Y');
        $heure = date('H:i');

        // On génère un token
        $token = substr(md5(rand()), 0, 10);
        // On insert le token dans la bdd
        $insert_token = $db -> prepare('UPDATE membres SET changepasskey=:changepasskey WHERE email=:email');
        $insert_token -> execute(array(
            'changepasskey' => $token, 
            'email' => $email
        ));
        
        // On définit les parties du mail
        $destinataire = $email;
        $sujet = "Nether News - Activation de votre compte";
        $headers = 'MIME-Version: 1.0'."\r\n".
          'Content-type: text/html; charset=utf-8'."\r\n".
          'From: gweedzy@gmail.com'."\r\n".
          'X-Mailer: PHP/' . phpversion();
        $message = "Vous avez demandé la réinitialisation du mot de passe de votre compte Nether News le $date à $heure. Cliquez sur ce lien ou copiez le dans votre barre de                 navigation : <a href='changingpassword.php' target='_blank'>http://notresite/changingpassword.php?pseudo=".urlencode($pseudo)."&token=".urlencode($token)."";

        // On envoie le mail
        mail($destinataire, $sujet, $message, $headers);
    } else {
        // Sinon on redirige vers la page de changement avec un message d'erreur
        header('Location: changer_mdp.php?error=true');
    }
}
    
    