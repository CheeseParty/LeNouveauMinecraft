<?php
# replycomment.php 
# Répondre à un commentaire

require('includes/connexion.php');
if(isset($_SESSION['AUTH'])) {
    if(isset($_POST['contenu']) AND !empty($_POST['contenu'])) {
        $insertrep = $db -> prepare('INSERT INTO membres id, idarticle, pseudo, contenu, date, gravatar, answer_to VALUES (:id, :idarticle, :pseudo, :contenu, :date, :gravatar, :answer_to)');
        $insertrep -> execute(array(
            'id' => '',
            'idarticle' = $_GET['article'],
            'pseudo' = $_SESSION['AUTH'],
            'contenu' = $_POST['contenu'],
            'date' => date('Y/m/d G:i'),
            'gravatar' => $_SESSION['MD5'],
            'answer_to' => $_POST['id']
        ));
    }
}

?>

