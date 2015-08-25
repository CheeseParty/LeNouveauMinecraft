<?php 
# delcomment.php 
# Supprimer un commentaire

session_start();
require('includes/connexion.php');

# Si l'utilisateur est connecté & admin
if(isset($_SESSION['AUTH'])) {
    if($_SESSION['RANK'] == 5) {
        # On supprime le commentaire correspondant à l'id de celui selectionné sur la page.
        $delcomment = $db -> prepare('DELETE FROM commentaires WHERE id=:id OR answer_to=:id');
        $delcomment->execute(array(
            'id' => $_POST['id']
        ));
    }
}

?>