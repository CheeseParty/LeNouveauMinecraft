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
                <h2 id="edit-zone">Zone d'édition et de lecture</h2>
                <form action="" method="post">
                    <label class="categorie">
                        Catégorie :
                        <select name="categorie">
                            <option value="0">Map</option>
                            <option value="1">Mod</option>
                            <option value="2">Version</option>
                            <option value="3">Plugin</option>
                            <option value="4">Texture</option>
                            <option value="5">Shader</option>
                            <option value="6">Cheat</option>
                            <option value="7">Divers</option>
                        </select>
                    </label>                
                    <label id="choose-pic">
                        <span>Thumbnail de l'article :</span>
                        <input type="hidden" id="thumbnail" name="thumbnail">
                        <img id="thumbimg">
                        <button type="button" onclick="choosePic(false)">Choisir</button>
                    </label>
                    <input type="text" name="titre" placeholder="Titre">
                    <textarea name="contenu" placeholder="Contenu" rows="20" onclick="contentChange(this)" onkeyup="contentChange(this)"></textarea>
                    <input type="hidden" name="mode">
                    <input type="hidden" name="id">
                </form>
                <div id="wcount">
                    Nombre de mots: 
                    <span>0</span>
                    <button id="insert-img" onclick="choosePic(true)">Insérer une image</button>
                </div><br>
                <button onclick="newArticle()">Nouvel article</button>
                <button class="save-btn" onclick="save()">Sauvegarder</button>
                <button class="publish-btn" onclick="publish()">Sauver et publier</button>
        </section>
        <iframe id="gallery" src="upload.php"></iframe>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
        <!-- Scripts -->
        <script type="text/javascript" src="xhr.js"></script>
        <script type="text/javascript" async defer>
        // Vars générales
        var form = document.querySelector("form");
        var categorie = document.getElementsByName("categorie")[0];
        var titre = document.getElementsByName("titre")[0];
        var mode = document.getElementsByName("mode")[0];
        var contenu = document.getElementsByName("contenu")[0];
        var id = document.getElementsByName("id")[0];
        var thumbnail = document.getElementById("thumbnail");
        var thumbimg = document.getElementById("thumbimg");
        
        // Save: AJAX / publish -> form.submit()
        function save() {
            var xhr = newXHR();
            var url = "save_article.php";
            var params = encodeURI( "id="+id.value+
                                    "&mode=save&titre="+titre.value+
                                    "&contenu="+contenu.value+
                                    "&categorie="+categorie.value+
                                    "&thumbnail="+thumbnail.value
                                  );
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    // Nouveau ligne dans le tableau des brouillons
                    if(document.getElementsByName("id")[0].value == "") {
                        var el_ligne = document.createElement("tr");
                        var el_titre = document.createElement("td");
                        el_titre.innerHTML = titre.value;
                        var el_edition = document.createElement("td");
                        var el_button = document.createElement("button");
                        el_button.innerHTML = "Editer";
                        el_button.setAttribute("onclick","edit("+xhr.response+")");
                        el_edition.appendChild(el_button);
                        el_ligne.appendChild(el_titre);
                        el_ligne.appendChild(el_button);
                        document.getElementById("brouillons").appendChild(el_ligne);
                        document.getElementsByName("id")[0].value = xhr.responseText;
                    } else {
                        var col_title = document.getElementsByClassName("titre-"+id.value)[0];
                        col_title.innerHTML = titre.value;
                    }
                }
            }
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8");
            xhr.send(params);
        }
            
        function publish() {
            form.action = "save_article.php";
            mode.value = "publish";
            form.submit();
        }

        var wcount = document.querySelector("#wcount span");
        function countWords(s){
            s = s.replace(/(^\s*)|(\s*$)/gi,"");//exclude  start and end white-space
            s = s.replace(/[ ]{2,}/gi," ");//2 or more space to 1
            s = s.replace(/\n /,"\n"); // exclude newline with a start spacing
            wcount.innerHTML = s.split(' ').length; 
        }

        function edit(i,mode) {
            var xhr = newXHR();
            var url = "read_article.php";
            var params = "id="+i;
            id.value = i;
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    if(xhr.responseText != "") {
                        var json = JSON.parse(xhr.responseText);
                        categorie.value = json.categorie;
                        titre.value = json.titre;
                        contenu.value = json.contenu;
                        thumbnail.value = json.thumbnail;
                        if(json.thumbnail != "") {
                            thumbimg.src = "upload/thumb/"+json.thumbnail;
                        }
                        countWords(contenu.value);
                        if(mode == true) {
                            titre.readOnly = true;
                            contenu.readOnly = true;
                            document.getElementsByClassName("save-btn")[0].disabled = true;
                            document.getElementsByClassName("publish-btn")[0].disabled = true;
                        } else {
                            titre.readOnly = false;
                            contenu.readOnly = false;
                            document.getElementsByClassName("save-btn")[0].disabled = false;
                            document.getElementsByClassName("publish-btn")[0].disabled = false;
                        }
                        location.hash = "#edit-zone";
                    }
                }
            }
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8");
            xhr.send(params);
            location.hash = "#edit-zone";
        }

        function newArticle() {
            if(confirm('En êtes-vous sûr? Tout contenu non-sauvegardé sera perdu.')) {
                id.value = "";
                categorie.value = "0";
                titre.value = "";
                contenu.value = "";
                thumbnail.value = "";
                thumbimg.src = "";
            }
        }
                                    
        function cursorPos(oField) {
            // Initialize
            var iCaretPos = 0;
            // IE Support
            if(document.selection) {
                // Set focus on the element
                oField.focus ();
                // To get cursor position, get empty selection range
                var oSel = document.selection.createRange ();
                // Move selection start to 0 position
                oSel.moveStart ('character', -oField.value.length);
                // The caret position is selection length
                iCaretPos = oSel.text.length;
            }
            // Firefox support
            else if(oField.selectionStart || oField.selectionStart == '0') {
                iCaretPos = oField.selectionStart;
            }
            // Return results
            return (iCaretPos);
        }
        
        var cursor_pos = 0;
        function contentChange(el) {
            countWords(el.value);
            cursor_pos = cursorPos(el);
        }

        var gallery = document.getElementById("gallery");
        var shown = false;
        var mode = false;
        function choosePic(m) {
            mode = m;
            if(shown) {
                document.body.style.overflowY = "visible";
                gallery.style.zIndex = -1;
                gallery.style.opacity = 0;
            } else {
                document.body.style.overflowY = "hidden";
                gallery.style.zIndex = 99;
                gallery.style.opacity = 1;
            }
            shown = !shown;
        }
        </script>
    </body>
</html>