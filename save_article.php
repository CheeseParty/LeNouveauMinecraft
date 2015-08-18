<?php
# SAVE_ARTICLE.PHP
# Enregistrement de l'article et/ou publication
session_start();

# Si la requête vient en XHR (Sauvegarder)
if(isset($_POST['mode']) AND $_POST['mode'] == "save") {
	# Vérification de l'utilisateur
	if(!isset($_SESSION['RANK']) OR $_SESSION['RANK'] < 2) {
		exit;
	}

	# Vérification de la requête
	if(!isset($_POST['titre']) OR !isset($_POST['contenu'])) {
		exit;
	}

	# Préparation de l'objet PDO
	require('includes/connexion.php');

	# Si un id est fourni, on update
	if(!empty($_POST['id'])) {
		$update = $db->prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie, thumbnail = :thumbnail WHERE id = :id AND auteur = :auteur');
		$update->execute(array(
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'id' => $_POST['id'],
			'auteur' => $_SESSION['AUTH'],
			'categorie' => $_POST['categorie'],
            'thumbnail' => $_POST['thumbnail']
			));
		$update->closeCursor();
	}

	# Sinon, on insert
	else {
		$insert = $db->prepare('INSERT INTO articles (id, categorie, titre, contenu, auteur, rang, thumbnail) VALUES (:id, :categorie, :titre, :contenu, :auteur, :rang, :thumbnail)');
		$insert->execute(array(
			'id' => '',
			'categorie' => $_POST['categorie'],
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'auteur' => $_SESSION['AUTH'],
			'rang' => $_SESSION['RANK'],
            'thumbnail' => $_POST['thumbnail']
			));
        echo $db->lastInsertId();
		$insert->closeCursor();
	}
	
}

# Si la requête ne vient pas en XHR (Sauver et publier)
elseif(isset($_POST['mode']) AND $_POST['mode'] == "publish") {
	# Vérification de la requête
	if(!isset($_POST['titre']) OR !isset($_POST['contenu'])) {
		exit;
	}

	# Préparation de l'objet PDO
	require('includes/connexion.php');
    
    # Si un id est donné, on update la colonne "publie"
    if(isset($_POST['id'])) {
        $update = $db -> prepare('UPDATE articles SET publication=:publication, publie=1 WHERE id=:id AND auteur=:auteur');
        $update -> execute(array(
            'publication' => ,
            'id' => $_POST['id'],
            'auteur' => $_SESSION['AUTH']
        ));
        
        # Si une ligne a été affectée
        if($db -> rowCount() > 0) {
            header("Location: write.php");
        }
        
        # Sinon
        else {
            exit;
        }
        
        # On ferme la requête
        $update -> closeCursor();
    }
    
    # Sinon, on insert
    else {
        # Si on a le rang suffisant
        if($_SESSION['RANK'] > 2) {
            $insert = $db -> prepare('INSERT INTO articles SET (id, categorie, titre, contenu, publication, auteur, rang, publie, thumbnail) VALUES (:id, :categorie, :titre, :contenu, :publication, :auteur, :rang, :publie, :thumbnail)');
            $insert -> execute(array(
                'id' => '',
                'categorie' => $_POST[''],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'publication' => date('Y-m-d G:i:s'),
                'auteur' => $_SESSION['AUTH'],
                'rang' => $_SESSION['AUTH'],
                'publie' => 1,
                'thumbnail' => $_POST['thumbnail']
            ));
            $insert -> closeCursor();
            header("Location: write.php");
        } else {
            exit;
        }
    }
}

# Si la requête est invalide
else {
	exit;
}