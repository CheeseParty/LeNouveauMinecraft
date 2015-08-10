<?php
# SAVE_ARTICLE.PHP
# Enregistrement de l'article et/ou publication
session_start();

# Si la requête vient en XHR (Sauvegarder)
if(isset($_POST['mode']) AND $_POST['mode'] == "save") {
	# Vérification de l'utilisateur
	if(!isset($_SESSION['RANK']) OR $_SESSION['RANK'] < 2) {
		echo $_SESSION['RANK'];
		exit;
	}

	# Vérification de la requête
	if(!isset($_POST['titre']) OR !isset($_POST['contenu'])) {
		echo 2;
		exit;
	}

	# Préparation de l'objet PDO
	require('includes/connexion.php');

	# Si un id est fourni, on update
	if(!empty($_POST['id'])) {
		$update = $db->prepare('UPDATE articles SET titre = :titre, contenu = :contenu, categorie = :categorie WHERE id = :id AND auteur = :auteur');
		$update->execute(array(
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'id' => $_POST['id'],
			'auteur' => $_SESSION['AUTH'],
			'categorie' => $_POST['categorie']
			));
		$update->closeCursor();
	}

	# Sinon, on insert
	else {
		$insert = $db->prepare('INSERT INTO articles (id, categorie, titre, contenu, auteur, rang) VALUES (:id, :categorie, :titre, :contenu, :auteur, :rang)');
		$insert->execute(array(
			'id' => '',
			'categorie' => $_POST['categorie'],
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'auteur' => $_SESSION['AUTH'],
			'rang' => $_SESSION['RANK']
			));
		echo $db->lastInsertId();
		$insert->closeCursor();
	}
	
}

# Si la requête ne vient pas en XHR (Sauver et publier)
elseif(isset($_POST['mode']) AND $_POST['mode'] == "publish") {
	echo "BANANA";
}

# Si la requête est invalide
else {
	echo 3;
	exit;
}