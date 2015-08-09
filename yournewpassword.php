<?php                       
// On passe au changement (update bdd)
// Si les 2 nouveaux pass entrés correspondent
require('includes/connexion.php');

if(isset($_POST['newpass']) && isset($_POST['newpass2']) && ($_POST['newpass'] === $_POST['newpass2'])) {
    // Alors on change le mot de passe
    $changemdp = $db -> prepare('UPDATE membres SET hash=? WHERE token=?');
    $changemdp -> execute(array(
        'hash' => password_hash($_POST['newpass'], CRYPT_BLOWFISH),
        'token' => $token
    ));
    $changemdp -> closeCursor();
}

?>