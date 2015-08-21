<?php 
#commentaires.php
#Commentaires pour chaque article avec possibilité d'en écrire bien évidemment

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
                <textarea name="commentaire" rows="5" maxlength="300" placeholder="Ecrivez votre commentaire ici.." required></textarea>
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
                    echo    "<span class='pseudo'><a class='userlink' href='user/".$data['pseudo']."/'>".$data['pseudo']."</a></span>";
                    echo    "<span class='date'> ".date('d-m-Y G:i:s', strtotime($data['date']))."</span>";
                    echo    "<span class='contenu'>".$data['contenu']."</span>";
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
            var md5 = "<?=$_SESSION['MD5']?>";
            var auth = "<?=$_SESSION['AUTH']?>";
            var datecontent = "<?=date('d-m-Y G:i:s', strtotime($data['date']))?>";
            var content = "<?=$data['contenu']?>";
            var admin = "<?=$_SESSION['RANK'] == 5?>";
        </script>
        
        <script type="text/javascript">
            function postComment() {
                var comment = document.getElementsByTagName('textarea')[0].value;
                var postcomment;
                if (window.XMLHttpRequest) {
                    postcomment = new XMLHttpRequest();
                } else {
                    postcomment = ActiveXObject('Microsoft.XMLHTTP');
                }
                
                postcomment.open("POST","postacomment.php",true);
                postcomment.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                postcomment.send("contenu="+comment);
                
                document.getElementById('commentaires').appendChild(commentairediv);
                commentairediv.appendChild(img); 
                commentairediv.appendChild(pseudo); 
                commentairediv.appendChild(date); 
                commentairediv.appendChild(commentaire); 
                commentairediv.appendChild(repbtn); 
            }
            
            var commentairediv = document.createElement("DIV");
            commentairediv.className = 'commentaire';
            
            var img = document.createElement("IMG");
            img.src = "http://www.gravatar.com/avatar/"+md5+"?d="+encodeURI('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
            img.className = 'avatar';
           
            var pseudo = document.createElement("A");
            pseudo.href = "user/"+auth+"/";
            pseudo.className = 'userlink';
            pseudo.innerHTML = auth;
          
            var date = document.createElement("P");
            date.className = 'date';
            date.innerHTML = datecontent;
          
            var commentaire = document.createElement("P");
            commentaire.className = 'contenu';
            commentaire.innerHTML = content;
            
            if(admin) {
                var delbtn = document.createElement("BUTTON");
                delbtn.className = "del_btn";
                delbtn.innerHTML = "Supprimer ♥";
                commentairediv.appendChild(delbtn); 
            }
            
            var repbtn = document.createElement("BUTTON");
            repbtn.className = "rep_btn";
            repbtn.innerHTML = "Répondre";
            
            
        </script>
        
    </body>
</html>