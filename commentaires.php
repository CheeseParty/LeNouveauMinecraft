<?php 
# COMMENTAIRE.PHP
# Commentaires pour chaque article avec possibilité d'en écrire bien évidemment

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
                <button class="send_btn" onclick="postComment()">Commenter</button>
             <?php // $ip = $_SERVER['REMOTE_ADDR']; echo"$ip";?>
        </div>
        <div id="commentaires">
            <?php 
                require('includes/connexion.php');
                # On va chercher le contenu de la bdd des commentaires pour l'article concerné ($_GET['article'])
                $selectcomms = $db -> prepare('SELECT id, answer_to, contenu, pseudo, date, gravatar FROM commentaires WHERE idarticle=:idarticle AND answer_to=0 ORDER BY date DESC');
                $selectcomms->execute(array(
                    'idarticle' => $_GET['article']
                    
                ));
                $selectreps = $db -> prepare('SELECT answer_to, contenu, pseudo, date, gravatar FROM commentaires WHERE idarticle=:idarticle AND answer_to!=0 ORDER BY date ASC');
                $selectreps -> execute(array(
                    'idarticle' => $_GET['article']
                ));
                # On fetch tous les commentaires
                $data = $selectcomms -> fetchAll();
                $data2 = $selectreps -> fetchAll();
                $answers = array_column($data2, "answer_to");
                $count = 0;
                # On fait la boucle
                foreach($data as $value) {
                        
                    $default = urlencode('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
                    echo "<div class='commentaire'>";
                    echo    "<img class='avatar' src='http://www.gravatar.com/avatar/".$value['gravatar']."?d=$default'/>";
                    echo    "<p class='pseudo'><a class='userlink' href='user/".$value['pseudo']."/'>".$value['pseudo']."</a></p>";
                    echo    "<p class='date'> ".date('d/m/Y G:i', strtotime($value['date']))."</p>";
                    echo    "<p class='contenu'>".$value['contenu']."</p>";
                    echo    "<div class='btns'>";
                    if(isset($_SESSION['AUTH'])) {
                        if($_SESSION['RANK'] == 5) {
                            echo    "<button class='del_btn'>Supprimer ♥</button>";
                        }
                    }
                    echo        "<button onclick='replyComment(".$value['id'].",$count)' class='rep_btn'>Répondre</button>";
                    echo    "</div>";
                    echo "</div>";
                    $count++;
                    # Et on affiche ses réponses                        
                    $keys = array_keys($answers, $value['id']);
                    if(!empty($keys)) {
                        foreach($keys as $key) {
                            $default = urlencode('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
                            echo "<div class='commentaire_reponse'>";
                            echo    "<img class='avatar' src='http://www.gravatar.com/avatar/".$data2[$key]['gravatar']."?d=$default'/>";
                            echo    "<p class='pseudo'><a class='userlink' href='user/".$data2[$key]['pseudo']."/'>".$data2[$key]['pseudo']."</a></p>";
                            echo    "<p class='date'> ".date('d/m/Y G:i', strtotime($data2[$key]['date']))."</p>";
                            echo    "<p class='contenu'>".$data2[$key]['contenu']."</p>";
                            echo    "<div class='btns'>";
                            if(isset($_SESSION['AUTH'])) {
                                if($_SESSION['RANK'] == 5) {
                                    echo    "<button class='del_btn'>Supprimer ♥</button>";
                                }
                            }
                            echo    "</div>";
                            echo "</div>";
                        }
                    }
                }
            ?>
                    
        </div>
        <script>
            // Si on mettait certaines de ces variables en cookie, on pourrait les utiliser en JS.
            var md5 = "<?=$_SESSION['MD5']?>";
            var auth = "<?=$_SESSION['AUTH']?>";
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

                    var datecontent = new Date();
                    var date = document.createElement("p");
                    date.className = 'date';
                    date.innerHTML = datecontent.getDate()+"/"+datecontent.getMonth()+"/"+datecontent.getFullYear()+" "+datecontent.getHours()+":"+datecontent.getMinutes();

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

                function replyComment(id, previous) {
                    var repzone = document.createElement('DIV');
                    repzone.className = "repzone";
                    
                    var textinrepzone = document.createElement('p');
                    textinrepzone.innerHTML = 'Répondez à ce commentaire...';
                    textinrepzone.className = 'textinrepzone';   
                    
                    var reptextabout = document.createElement('p');
                    reptextabout.innerHTML = "Vous devez être connecté pour répondre";
                    reptextabout.className = 'reptextabout';
                    
                    var reptextarea = document.createElement("textarea");
                    reptextarea.className = "reptextarea";
                    
                    var sendrep_btn = document.createElement("button");
                    sendrep_btn.className = "sendrep_btn";
                    sendrep_btn.innerHTML = "Répondre";
                    sendrep_btn.onclick = "postReply()";
                    
                    var commentaires = document.getElementById("commentaires");
                    
                    
                    repzone.appendChild(textinrepzone);
                    repzone.appendChild(reptextarea);
                    repzone.appendChild(sendrep_btn);
                    repzone.appendChild(reptextabout);
                    commentaires.insertBefore(repzone, document.querySelectorAll('.commentaire')[1+previous]);
                }
                
                function postReply() {
                    var rep = document.getElementsByClassName('textarea')[0].value;
                    if(rep !== "") {
                        var postrep;
                        if (window.XMLHttpRequest) {
                            postrep = new XMLHttpRequest();
                        } else {
                            postrep = ActiveXObject('Microsoft.XMLHTTP');
                        }

                        postrep.open("POST","replycomment.php",true);
                        postrep.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        postrep.send("answer_to="+id);             
                    }            
                }
            </script>

    </body>
</html>