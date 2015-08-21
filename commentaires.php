<?php 
#commentaires.php
#Commentaires pour chaque article avec possibilité d'en écrire bien évidemment lel

    session_start();
?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="commentaires.css">
        <meta charset="utf-8">
    </head>
    
    <body>
         <div id="postcommentaire">
            <p class="comment-title">Donnez votre avis ! <span>(300 caractères maximum)</span></p>
                <textarea name="commentaire" rows="5" maxlength="300" placeholder="Ecrivez votre commentaire ici.." ></textarea>
                  <?php 
                if(isset($_GET['posted'])) {
                    echo "<p class='true'>Votre commentaire a été posté.</p>";
                }
            ?>
                <button class="form_btn" onclick="postComment()">Commenter</button>
             <?php //$ip = $_SERVER['REMOTE_ADDR']; echo"$ip";?>
        </div>
        <div id="commentaires">
            <?php 
                require('includes/connexion.php');
                #On va chercher le contenu de la bdd des commentaires pour l'article concerné ($_GET['article'])
                $selectcomms = $db -> prepare('SELECT contenu, pseudo, date, gravatar FROM commentaires WHERE idarticle=:idarticle ORDER BY date DESC');
                $selectcomms->execute(array(
                    'idarticle' => $_GET['article']
                ));
                #On affiche tous les commentaires
                while($data = $selectcomms -> fetch()) {
                    $default = urlencode('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
                    echo "<div class='commentaire'>";
                    echo    "<img class='avatar' src='http://www.gravatar.com/avatar/".$data['gravatar']."?d=$default'/>";
                    echo    "<p class='pseudo'><a class='userlink' href='user/".$data['pseudo']."/'>".$data['pseudo']."</a></p>";
                    echo    "<p class='date'> ".date('d/m/Y G:i', strtotime($data['date']))."</p>";
                    echo    "<p class='contenu'>".$data['contenu']."</p>";
                    echo    "<div class='btns'>";
                    if(isset($_SESSION['AUTH'])) {
                        if($_SESSION['RANK'] == 5) {
                        echo    "<button class='del_btn'>Supprimer ♥</button>";
                    } }
                    echo        "<button class='rep_btn'>Répondre</button>";
                    echo    "</div>";
                    echo "</div>";
                }
                    
            ?>
                    
        </div>
        <script>
            // Si on mettait certaines de ces variables en cookie, on pourrait les utiliser en JS.
            var md5 = "<?=$_SESSION['MD5']?>";
            var auth = "<?=$_SESSION['AUTH']?>";
            // Utiliser JS pour générer la date
            var datecontent = new Date();
            console.log(datecontent.getDate());
            console.log(datecontent.getMonth());
            console.log(datecontent.getFullYear());
            console.log(datecontent.getHours());
            console.log(datecontent.getMinutes());
            console.log(datecontent.getSeconds());
            var admin = "<?=$_SESSION['RANK'] == 5?>";
        </script>
        
        <script type="text/javascript">
            function insertComment() {
                var commentairediv = document.createElement("DIV");
                commentairediv.className = 'commentaire';

                var img = document.createElement("IMG");
                img.src = "http://www.gravatar.com/avatar/"+md5+"?d="+encodeURI('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
                img.className = 'avatar';
                
                var pseudo = document.createElement("p");
                pseudo.className = 'pseudo';
                
                var user = document.createElement("a");
                user.href = "user/"+auth+"/";
                user.className = 'userlink';
                user.innerHTML = auth;
                
                var date = document.createElement("p");
                date.className = 'date';
                date.innerHTML = datecontent;

                var commentaire = document.createElement("p");
                commentaire.className = 'contenu';
                commentaire.innerHTML = document.getElementsByTagName('textarea')[0].value;
                
                var btns = document.createElement("DIV");
                btns.className = 'btns';
                
                if(admin) {
                    var delbtn = document.createElement("button");
                    delbtn.className = "del_btn";
                    delbtn.innerHTML = "Supprimer ♥";
                    btns.appendChild(delbtn); 
                }

                var repbtn = document.createElement("button");
                repbtn.className = "rep_btn";
                repbtn.innerHTML = "Répondre";
                
                pseudo.appendChild(user);
                commentairediv.appendChild(img); 
                commentairediv.appendChild(pseudo); 
                commentairediv.appendChild(date); 
                commentairediv.appendChild(commentaire); 
                commentairediv.appendChild(btns);
                btns.appendChild(repbtn);
                
                return commentairediv;
            }
            
            function postComment() {
                
                
                var comment = document.getElementsByTagName('textarea')[0].value;
                if(comment !== "") {
                    var postcomment;
                    if (window.XMLHttpRequest) {
                        postcomment = new XMLHttpRequest();
                    } else {
                        postcomment = ActiveXObject('Microsoft.XMLHTTP');
                    }

                    postcomment.open("POST","postacomment.php",true);
                    postcomment.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    postcomment.send("contenu="+comment);
                    document.getElementById("commentaires").insertBefore(insertComment(), document.querySelector('.commentaire:first-child'));                     
            }            
            }
        </script>
        
    </body>
</html>