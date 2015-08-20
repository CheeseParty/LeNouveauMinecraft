<?php
    session_start();
    
if(isset($_SESSION['AUTH'])) {
    if(isset($_POST['postcomment']) AND isset($_POST['commentaire'])) {
        require('includes/connexion.php');
        $postcomment = $db -> prepare('INSERT INTO commentaires (id, idarticle, contenu, pseudo, date, gravatar) VALUES (:id, :idarticle, :contenu, :pseudo, :date, :gravatar)');
        $postcomment -> execute(array(
            'id' => '',
            'idarticle' => '',
            'contenu' => $_POST['commentaire'],
            'pseudo' => $_SESSION['AUTH'],
            'date' => date('Y-m-d G:i:s'),
            'gravatar' => $_SESSION['MD5']
        ));
    header('Location: commentaires.php?posted=true');
        
    }}