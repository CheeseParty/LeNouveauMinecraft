<?php
// READ_ARTICLE.PHP
// Retourne la catégorie, le titre et le contenu d'un message en JSON en fonction d'un id
session_start();

# Vérification de la requête
if(!isset($_SESSION['RANK']) OR $_SESSION['RANK'] < 2 OR !isset($_POST['id'])) {
	exit;
}

# Va chercher le data
require('includes/connexion.php');
$read = $db->prepare('SELECT categorie, titre, contenu, thumbnail, version FROM articles WHERE id=?');
$read->execute(array($_POST['id']));
if($read->rowCount() > 0) {
	while($data = $read->fetch()) {
		$array['categorie'] = $data['categorie'];
		$array['titre'] = $data['titre'];
		$array['contenu'] = $data['contenu'];
        $array['thumbnail'] = $data['thumbnail'];
        $array['version'] = $data['version'];
	}
	# Encode et retourne la réponse
	echo json_encode($array);
}