<?php
# ARTICLES.PHP
# Inclusion de l'article

session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - News sur le jeu de type "sandbox"</title>
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="../../articles.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <header id="header">
            <a id="title" href="../../"><h1>Nether News</h1></a>       
        </header>
        <section>
            <?php
                if((@include('cache/articles/'.$_GET['article'].'.php')) === false) {
                    echo "<h2>L'article que vous demandez n'existe pas.</h2>";
                    echo "<a href='../../'>Retourner à l'accueil</a>";
                }
            ?>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
    </body>
</html>