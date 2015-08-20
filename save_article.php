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
        # S'il est admin, il peut modifier ce qu'il veut
        if($_SESSION['RANK'] >= 4) {
            $update = $db->prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie, thumbnail = :thumbnail, version = :version WHERE id = :id');
            $update->execute(array(
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'id' => $_POST['id'],
                'categorie' => $_POST['categorie'],
                'thumbnail' => $_POST['thumbnail'],
                'version' => $_POST['version']
                ));
            $update->closeCursor();
        }

        # Sinon
        else {
            $update = $db->prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie, thumbnail = :thumbnail, version = :version WHERE id = :id AND auteur = :auteur');
            $update->execute(array(
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'id' => $_POST['id'],
                'auteur' => $_SESSION['AUTH'],
                'categorie' => $_POST['categorie'],
                'thumbnail' => $_POST['thumbnail'],
                'version' => $_POST['version']
                ));
            $update->closeCursor();
        }
    }

	# Sinon, on insert un nouvel article
	else {
		$insert = $db->prepare('INSERT INTO articles (id, categorie, titre, contenu, auteur, rang, thumbnail, version) VALUES (:id, :categorie, :titre, :contenu, :auteur, :rang, :thumbnail, :version)');
		$insert->execute(array(
			'id' => '',
			'categorie' => $_POST['categorie'],
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'auteur' => $_SESSION['AUTH'],
			'rang' => $_SESSION['RANK'],
            'thumbnail' => $_POST['thumbnail'],
            'version' => $_POST['version']
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
        # Les rédacteurs peuvent modifier les articles des autres
        if($_SESSION['RANK'] >= 3) {
            $update = $db -> prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie, thumbnail = :thumbnail, version = :version, publication=:publication, publie=1 WHERE id=:id');
            $update -> execute(array(
                'categorie' => $_POST['categorie'],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'thumbnail' => $_POST['thumbnail'],
                'version' => $_POST['version'],
                'publication' => date('Y-m-d G:i:s'),
                'id' => $_POST['id']
            ));
            
            # S'il y a eu un changement, on met à jour le cache
            if($update -> rowCount() > 0) {
                require('includes/build_cache.php');
            }
        }
            
        # Les rédacteurs à l'essai ne peuvent pas
        else {
            $update = $db -> prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie, thumbnail = :thumbnail, version = :version, publication=:publication, publie=1 WHERE id=:id AND auteur=:auteur');
            $update -> execute(array(
                'categorie' => $_POST['categorie'],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'thumbnail' => $_POST['thumbnail'],
                'version' => $_POST['version'],
                'publication' => date('Y-m-d G:i:s'),
                'id' => $_POST['id'],
                'auteur' => $_SESSION['AUTH']
            ));
            
            # S'il y a eu un changement, on met à jour le cache
            if($update -> rowCount() > 0) {
                require('includes/build_cache.php');
            }
        }
        
        # Si une ligne a été affectée, on redirige
        if($update -> rowCount() > 0) {
            header("Location: write.php");
        }
        
        # On ferme la requête
        $update -> closeCursor();
    }
        
    # Sinon, on insert un nouvel article
    else {
        # Si on a le rang suffisant
        if($_SESSION['RANK'] > 2) {
            $insert = $db -> prepare('INSERT INTO articles SET (id, categorie, titre, contenu, publication, auteur, rang, publie, thumbnail, version) VALUES (:id, :categorie, :titre, :contenu, :publication, :auteur, :rang, :publie, :thumbnail, :version)');
            $insert -> execute(array(
                'id' => '',
                'categorie' => $_POST[''],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'publication' => date('Y-m-d G:i:s'),
                'auteur' => $_SESSION['AUTH'],
                'rang' => $_SESSION['AUTH'],
                'publie' => 1,
                'thumbnail' => $_POST['thumbnail'],
                'version' => $_POST['version']
            ));
            
            # S'il y a eu un changement, on met à jour le cache
            if($insert -> rowCount() > 0) {
                require('includes/build_cache.php');
            }
            
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