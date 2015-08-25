<?php
# POSTACOMMENT.php
# Envoyer un commentaire à la bdd
    session_start();
# Si l'utilisateur est co & que le commentaire n'est pas vide    
if(isset($_SESSION['AUTH'])) {
    if(isset($_POST['contenu']) AND !empty($_POST['contenu'])) {
        require('includes/connexion.php');
        $postcomment = $db -> prepare('INSERT INTO commentaires (id, idarticle, contenu, pseudo, date, gravatar) VALUES (:id, :idarticle, :contenu, :pseudo, :date, :gravatar)');
        $postcomment -> execute(array(
            'id' => '',
            'idarticle' => $_POST['idarticle'],
            'contenu' => $_POST['contenu'],
            'pseudo' => $_SESSION['AUTH'],
            'date' => date('Y/m/d G:i'),
            'gravatar' => $_SESSION['MD5']
        ));
        
    }
        
}
?>