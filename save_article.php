<?php
// SAVE_ARTICLE.PHP
// Enregistrement de l'article et/ou publication

# Vérification de l'utilisateur
if(!isset($_SESSION['RANK']) OR $_SESSION['RANK'] < 2) {
	exit;
}

# Vérification de la requête
if(!isset($_POST['mode']) OR !isset($_POST['titre']) OR !isset($_POST['contenu'])) {
	exit;
}

# Rang: rédacteur en chef, administrateur
if($_SESSION['RANK'] >= 4) {
	# Sauvegarde
	require('includes/connexion.php');
	$db->prepare('');
}

# Si un id est fourni, on update. Sinon, on insert.