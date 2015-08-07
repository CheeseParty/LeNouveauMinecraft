<?php

// TODO? Mettre en cache la page?
// -> Economies CPU + bdd sur les profils très consultés,
//    mais prends de l'espace disque souvent inutilement...

    session_start();
    // Si le profil demandé existe, $exist = true
    $exist = true;
    $same = false;
    // Si le profil à consulter est celui de l'utilisateur
    if(isset($_SESSION['AUTH']) AND $_GET['user'] == $_SESSION['AUTH']) {
        $same = true;
        $rank = $_SESSION['RANK'];
        $date = $_SESSION['DATE'];
        $mail = $_SESSION['MAIL'];
    }
    // Sinon, aller chercher dans la bdd
    else {
        // Aller chercher les informations du profil demandé
        require('includes/connexion.php');
        $request = $db->prepare('SELECT email, rank, inscription FROM membres WHERE pseudo=?');
        $request->execute(array($_GET['user']));
        if($request->rowCount() > 0) {
            while($data = $request->fetch()) {
                $mail = $data['email'];
                $rank = $data['rank'];
                $date = $data['inscription'];
            }
        } else {
            $exist = false;
        }
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - Votre profil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="../../user.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="57x57" href="../../favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../../favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../../favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../../favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../../favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../../favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../../favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../../favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../../favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../../favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../../favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../favicons/favicon-16x16.png">
        <link rel="manifest" href="../../favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../../favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <header>
            <a href="../../">
                <h1>Nether News</h1>
            </a>
        </header>
        <section>
            <?php if($exist): ?>
                <?php if($same): ?>
                    <h2>Votre profil (<?=$_GET['user']?>)</h2>
                <?php else: ?>
                    <h2>Profil de <?=$_GET['user']?></h2>
                <?php endif ?>
                <img src="http://www.gravatar.com/avatar/<?=md5(strtolower(trim($mail)))?>?s=200">
                <?php if($same): ?>
                    <a href="//fr.gravatar.com" target="_blank">Personnaliser mon avatar</a>
                <?php endif ?>
                <table>
                    <caption>Informations</caption>
                    <tr>
                        <td>Rang</td>
                        <td>
                        <?php
                            // Détermination du rang
                            switch($rank) {
                                case '0':
                                    echo "Membre";
                                    break;

                                case '1':
                                    echo "Rédacteur";
                                    break;

                                case '2':
                                    echo "Administrateur";
                                    break;
                            }
                        ?>
                        </td> 
                    </tr>
                    <tr>
                        <td>Inscrit le</td>
                        <td><?=$date?></td> 
                    </tr>
                </table>
            <?php else: ?>
                <h2>Désolé, le profil que vous avez demandé n'existe pas.</h2>
                <a href="../../">Retourner à l'acceuil</a>
            <?php endif ?>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
    </body>
</html>