<?php
# replycomment.php 
# Répondre à un commentaire
session_start();
require('includes/connexion.php');

# Si l'utilisateur est connecté
if(isset($_SESSION['AUTH'])) {
    # Et que le champ "reponse" est rempli
    if(isset($_POST['contenu']) AND !empty($_POST['contenu'])) {
        # On insere tout dans la bd
        $insertrep = $db -> prepare('INSERT INTO commentaires (id, idarticle, pseudo, contenu, date, gravatar, answer_to) VALUES (:id, :idarticle, :pseudo, :contenu, :date, :gravatar, :answer_to)');
        $insertrep -> execute(array(
            'id' => '',
            'idarticle' => '',
            'pseudo' => $_SESSION['AUTH'],
            'contenu' => $_POST['contenu'],
            'date' => date('Y/m/d G:i:s'),
            'gravatar' => $_SESSION['MD5'],
            'answer_to' => $_POST['answer_to']
        ));
        
    }
}

?>
