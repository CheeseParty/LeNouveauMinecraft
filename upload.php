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
        <link rel="stylesheet" href="upload.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <header>
            <a href="/">
                <h1>Nether News</h1>
            </a>
        </header>
        <section>
            <form action="upload_process.php" method="post" enctype="multipart/form-data">
                <h2>Upload images</h2>
                Votre JPG à uploader
                <input required type="file" name="fileToUpload" id="fileToUpload" accept="image/jpg,image/jpeg">
                <input type="submit" value="Valider" name="submit">
            </form>
            <div id="container"></div>
        </section>
    <?php
        # Génération de l'array de noms de fichiers
        $dir = realpath(dirname(__FILE__)).'/';
        $files = scandir($dir, 1);
        $dirfull = $dir."full/";
        $img_array = [];
        foreach($files as $file) {
            if(stripos($file, '.jpg') !== false) {
                $img_array[] = "'".$file."'";
            }
        }
        $array_str = implode(',', $img_array);
    ?>
    <script>
        // Création de la galerie
        var img_array = [<?=$array_str?>];
        
        var img_obj = document.createElement("img");
        img_obj.className = "img";
        img_obj.setAttribute("onload","displayThumb(this)");

        var container = document.getElementById("container");

        var show_more = document.createElement("button");
        show_more.id = "show_more";
        show_more.innerHTML = "Montrer plus";
        show_more.setAttribute("onclick","createGallery()");

        var count = 0;

        document.body.onload = function() {
            if(img_array)
            var limit = 0;
            if(img_array.length >= 24) {
                limit = 24;
            } else {
                limit = img_array.length;
            }
            for(var i = 0; i < limit; i++) {
                var img = img_obj.cloneNode(true);
                img.src = "img/"+img_array[i];
                img.id = "img-"+count;
                img.setAttribute("onclick","copyName("+img_array[count]+")");
                container.appendChild(img);
                count++;
            }
            img_array.splice(0,limit);
            if(img_array != "") {
                container.appendChild(show_more);
            } else {
                container.removeChild(show_more);
            }
        }
        
        function copyName(src) {
            window.prompt("Copier le nom de l'image: Ctrl+C, Enter", src);
        }
    </script>
    </body>
</html>