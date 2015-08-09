<?php                       
// On passe au changement (update bdd)

// On inclut ce qui est nécessaire à la connexion à la bdd
require('includes/connexion.php');

// Si les 2 nouveaux pass entrés correspondent
if(isset($_POST['newpass']) && isset($_POST['newpass2']) && ($_POST['newpass'] === $_POST['newpass2'])) {
    $token = $_GET['token'];
    // Alors on change le mot de passe
    $changemdp = $db -> prepare('UPDATE membres SET hash=:hash WHERE changepasskey=:token');
    $changemdp -> execute(array(
        'hash' => password_hash($_POST['newpass'], CRYPT_BLOWFISH),
        'token' => $token
    ));
    $changemdp -> closeCursor();
    // Et on redirige
    header('Location : changer_mdp.php?passwordchanged=true');
} else {
    // Sinon on redirige avec message d'erreur
    header('Location: changingpassword.php?error=true');
}

?>