<?php
# WRITE.PHP
# Page d'écriture d'articles si l'utilisateur dispose d'un rang de 1 ou plus. (>=Rédacteur)

session_start();

# Vérification du rang
if(!isset($_SESSION['RANK']) OR  $_SESSION['RANK'] < 2) {
    exit("redirect");
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - Upload</title>
        <link rel="stylesheet" href="upload.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <section>
            <button type="button" id="close-button" onclick="parent.choosePic()">X</button>
            <form action="upload_process.php" method="post" enctype="multipart/form-data">
                <h2>Choisissez une image ou uploadez celle(s) de votre choix</h2>
                Image(s) à uploader
                <input required type="file" name="fileToUpload[]" multiple>
                <input type="submit" value="Upload" name="submit">
            </form><br>
            <div id="container"></div>
        </section>
    <?php
        # Génération de l'array de noms de fichiers
        $dir = realpath(dirname(__FILE__)).'/upload/thumb';
        $files = scandir($dir, 1);
        $img_array = [];
        foreach($files as $file) {
            if(stripos($file, '.jpg') !== false) {
                $img_array[] = "'".$file."'";
            }
        }
        $array_str = implode(',', $img_array);
    ?>
    <script>
        // Fondu au chargement
        function displayThumb(img) {
            img.style.opacity = 1;
        }
        
        function usePic(name) {
            window.parent.document.getElementById("thumbnail").value = name;
            window.parent.document.getElementById("thumbimg").src = "upload/thumb/"+name;
            window.parent.choosePic();
        }
        
        // Création de la galerie
        var img_array = [<?=$array_str?>];
        
        var img_obj = document.createElement("img");
        img_obj.setAttribute("onload","displayThumb(this)");

        var container = document.getElementById("container");

        var show_more = document.createElement("button");
        show_more.id = "show_more";
        show_more.innerHTML = "Montrer plus";
        show_more.setAttribute("onclick","createGallery()");

        var count = 0;
        var first_load = true;

        function createGallery() {
            var limit = 0;
            if(img_array.length >= 24) {
                limit = 24;
            } else {
                limit = img_array.length;
            }
            for(var i = 0; i < limit; i++) {
                var img = img_obj.cloneNode(true);
                img.src = "upload/thumb/"+img_array[i];
                img.id = "img-"+count;
                img.setAttribute("onclick","usePic('"+img_array[i]+"')");
                container.appendChild(img);
                count++;
            }
            img_array.splice(0,limit);
            if(img_array != "") {
                container.appendChild(show_more);
            } else if(!first_load) {
                container.removeChild(show_more);
            }
            first_load = false;
        }
        document.body.onload = createGallery();
    </script>
    </body>
</html>