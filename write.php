<?php
// WRITE.PHP
// Page d'écriture d'articles si l'utilisateur dispose d'un rang de 1 ou plus. (>=Rédacteur)
    session_start();

    // Vérification du rang
    if(!isset($_SESSION['RANK']) OR  $_SESSION['RANK'] < 2) {
        header('Location: index.php');
        exit;
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - Votre profil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="write.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <header>
            <a href="../../">
                <h1>Nether News</h1>
            </a>
        </header>
        <section>
            <?php require('includes/connexion.php'); ?>

            <?php
                # Rang: rédacteur en chef, administrateur
                if($_SESSION['RANK'] >= 4) {
                    require('includes/write4.php');
                } 

                # Rang: rédacteur
                elseif($_SESSION['RANK'] == 3) {
                    require('includes/write3.php');
                }

                # Rang: rédacteur à l'essai
                else {
                    require('includes/write2.php');
                }
            ?>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
    </body>
</html>