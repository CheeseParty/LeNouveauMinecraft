<?php
# UPLOAD_PROCESS.PHP
# Traitement de l'envoi de l'image depuis upload.php

session_start();

# Vérification du rang
if(!isset($_SESSION['RANK']) OR  $_SESSION['RANK'] < 2) {
    exit('Erreur: Rang insuffisant');
}

# Récupération du prochain numéro d'image et inscription dans number.txt
$file = fopen('includes/number.txt', 'r+');
$next_number = fgets($file);

# Plugin pour crop
require('includes/crop.php');

# Boucle qui passe dans les fichiers
foreach($_FILES['fileToUpload']['error'] as $key => $error) {
    if($error == UPLOAD_ERR_OK) {
        # Noms des fichiers
        $full_dir = 'upload/full/'.$next_number.'.jpg';
        $thumb_dir = 'upload/thumb/'.$next_number.'.jpg';

        # Déplacement des fichiers temporaires dans leurs emplacements définitifs
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$key], $full_dir);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$key], $thumb_dir);
                
        # Création des deux formats de l'image
        resize_crop_image(200, 200, $full_dir, $thumb_dir, 50);
        resize_crop_image(960, 540, $full_dir, $full_dir, 80);
        
        # Changement du prochain nom de fichier
        $next_number++;
    }
}

# Mise à jour du prochain nom de fichier
ftruncate($file,0);
fseek($file, 0);
fwrite($file, $next_number);
fclose($file);

# Redirection
header('Location: upload.php');