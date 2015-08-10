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

                # Pour tous les rangs, on peut écrire un article
                ?>
                <h2>Zone d'édition</h2>
                <form action="" method="post">
                    <label>
                        Catégorie:
                        <select name="categorie">
                            <option value="0">Map</option>
                            <option value="1">Mod</option>
                            <option value="2">Version</option>
                            <option value="3">Plugin</option>
                            <option value="4">Texture</option>
                            <option value="5">Shader</option>
                            <option value="6">Cheats</option>
                            <option value="7">Divers</option>
                        </select>
                    </label>
                    <input type="text" name="titre" placeholder="Titre">
                    <textarea name="contenu" placeholder="Contenu" rows="20" onkeyup="countWords(this.value)"></textarea>
                    <input type="hidden" name="mode">
                    <input type="hidden" name="id">
                </form>
                <div id="wcount">
                    Nombre de mots: 
                    <span>0</span>
                </div><br>
                <button onclick="save()">Sauvegarder</button>
                <button onclick="publish()">Sauver et publier</button>


                <br><br><div id="test"></div>

                <!-- Ne pas déplacer ces scripts! En cours d'édition-->
                <script type="text/javascript" src="xhr.js"></script>
                <script type="text/javascript" async defer>
                var form = document.querySelector("form");
                var mode = document.getElementsByName("mode")[0];

                // Save: AJAX / publish -> form.submit()
                function save() {
                    var xhr = newXHR();
                    var url = "save_article.php";
                    var categorie = document.getElementsByName("categorie")[0].value;
                    var titre = document.getElementsByName("titre")[0].value;
                    var contenu = document.getElementsByName("contenu")[0].value;
                    var id = document.getElementsByName("id")[0].value;
                    var params = encodeURI("id="+id+"&mode=save&titre="+titre+"&contenu="+contenu+"&categorie="+categorie);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                            document.getElementsByName("id")[0].value = xhr.responseText;
                            document.getElementById("test").innerHTML = xhr.responseText;
                        }
                    }
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8");
                    xhr.send(params);
                    console.log(params);
                }

                function publish() {
                    form.action = "save_article.php";
                    mode.value = "publish";
                    id.value = "";
                    form.submit();
                }

                var wcount = document.querySelector("#wcount span");
                function countWords(s){
                    s = s.replace(/(^\s*)|(\s*$)/gi,"");//exclude  start and end white-space
                    s = s.replace(/[ ]{2,}/gi," ");//2 or more space to 1
                    s = s.replace(/\n /,"\n"); // exclude newline with a start spacing
                    wcount.innerHTML = s.split(' ').length; 
                }
                </script>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
    </body>
</html>