<?php
// reinit-mdp_process.php
// Page qui change le password

// Si les champs sont bien remplis
if(isset($_POST['pseudo']) && isset($_POST['password']))
{
    // Alors on envoie un mail à l'utilisateur avec son token (oui oui)
    
    // Même (ou presque) fonctionnement que pour validation compte
    
    // Si le token est bon on UPDATE le mot de passe en le réencryptant 
}
