<?php
// reinit-mdp_process.php
// Page qui change le password

// Si les champs sont bien remplis
if(isset($_POST['pseudo']) && isset($_POST['password'])) {
    // Alors on va chercher l'email de l'utilisateur dans la bdd
    $getemail = $db -> prepare('SELECT email FROM membres WHERE pseudo=?');
    $getemail -> execute(array(
        'pseudo' => $_POST['pseudo']
    ));
    $email_stock = $getemail->fetchAll();
    // L'email de l'utilisateur est donc stockée dans $email
    $email = ($email_stock[0]["email_stock"]);
    // On ferme la requête bdd
    $getemail -> closeCursor();
    
    // Si l'utilisateur existe
    if($getemail = rowCount() > 0) {
        // On va chercher le token qui correspond au pseudo dans la BDD
        $get_token = $db -> prepare('SELECT token FROM membres WHERE pseudo=?');
        $get_token->execute(array(
            'pseudo' => $_POST['pseudo']
        ));
        $token_stock = $get_token->fetchAll();
        // Le token de l'utilisateur est donc stocké dans $token
        $token = ($token_stock[0]["token_stock"]);
        // On ferme la requête bdd
        $get_token -> closeCursor();
        
        // On définit les variables necessaires à l'envoi de l'email
        $destinataire = $email;
        $sujet = "Nether News - Réinitialisation de votre mot de passe";
        // Entete (contient les parametres de l'email)
        $headers = 'MIME-Version: 1.0'."\r\n".
          'Content-type: text/html; charset=utf-8'."\r\n".
          'From: gweedzy@gmail.com'."\r\n".
          'X-Mailer: PHP/' . phpversion();
        $date = date('d-m-Y');
        $heure = date('H:i');
    // MESSAGE A FAIRE AVEC LE DESIGN DE LAUTRE  (valid compte)     
        $message = "Vous avez demandé la réinitialisation de votre mot de passe le $date à $heure, cliquez sur ce lien pour le réinitialiser : <a href='reinitialisation_mdp?pseudo=".urlencode($pseudo)."&cle=".urlencode($token)." Si ce n'est pas vous, merci d'ignorez ce message.";
    } else {
        // Sinon on redirige sur la page de réinit mais avec un $_GET d'erreur
        header('Location: reinitialisation_mdp?error=true');
    }
        
}
