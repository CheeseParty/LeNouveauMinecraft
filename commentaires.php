<!-- 
    COMMENTAIRE.PHP
    Commentaires pour chaque article avec possibilité d'en écrire bien évidemment (page inclue sur chaque article)
-->

<!doctype html>
<html>
    <head>
       
        <meta charset="utf-8">
        <style>
            * {
                font-family:"Roboto Condensed";
            }
            #commentaires, #postcommentaire {
                width:1000px;
                margin:0 auto;
            }

            .comment-title {
                font-size: 20px;
                margin:0;
                padding-bottom: 20px;
            }

            .comment-title span {
                font-size: 15px;
            }

            textarea, .textarearep{
                width:100%;
                font-size:12pt;
                padding:10px;
                display: block;
                font-family:'Roboto condensed';
                resize:none;
            }

            textarea:focus {
                outline-color:#2C8607;
            }

            .send_btn, .sendrep_btn {
                background-color:#329609;
                border:0;
                padding:10px 20px;
                display:block;
                color:#fff;
                font-size:12pt;
                cursor:pointer;
                transition:all 0.3s ease;
                margin: 20px auto;
            }

            .sendrep_btn {
                font-size:10pt;
                padding:5px 10px;
                margin:5px 0 0 33px;
                display:inline-block;
            }
            .send_btn:hover, .sendrep_btn:hover{
                background-color:#38A70A;
            }

            .true {
                color:#329609;
                text-align: center;
                padding: 4px;

            }

            .commentaire,.commentaire_reponse,.repzone {
                background-color:#fff;
                padding:20px;
                border:1px solid #ededed;

            }

            .commentaire {
                width: 100%;
                margin: 20px auto 0 auto;
            }

            .commentaire_reponse, .repzone {
                width:90%;
                margin: 7px 0 0 10%;

            }
            .avatar {
                width:80px;
            }
            .pseudo {
                font-size:15pt;
                display:inline-block;
                position:absolute;
                margin:0;
                margin-left:15px;
            }

            .date {
                display: inline-block;
                margin-top:5px;
                float:right;
                font-size:9pt;
                color:#848484;
            }

            .contenu {
                font-size:12px;
                display:inline-block;
                margin: 30px 0 0 22px;
                position:absolute;
                width:700px;
                line-height:20px;
            }

            .userlink {
                color:#3C3C3C;
                text-decoration:none;
            }

            .btns{
                width:100%;
                text-align:right;
                margin-top:-10px;

            }
            .rep_btn, .del_btn {
                display:inline-block;
                padding:4px 10px;
                margin:0;
                font-size:12px;
                border:0;
                cursor:pointer;
                transition: all 0.25s ease;
                color:#fff;
            }


            .del_btn {
                margin-right:15px;
                background-color:#A83E94;
                border: 1px solid #A83E94;
            }

            .del_btn:hover {
                background-color:#fff;
                color:#A83E94;
                border:1px solid #A83E94;
            }
            .rep_btn {
                background-color:#778172;
                border: 1px solid #778172;

            }

            .rep_btn:hover {
                background-color:#fff;
                border:1px solid #329609;
                color:#329609;

            }

            .reptextarea {
                width:90%;
                margin:0 auto;
            }

            .textinrepzone {
                display:block;
                width:92.3%;
                margin:0 auto;  
                font-size:11pt;
                padding-bottom: 3px;
            }
            
            .reptextabout {
                font-size:9pt;
                display:inline-block;
                margin-left:10px;
            }
            
        </style>
    </head>
    
    <body>
         <div id="postcommentaire">
            <p class="comment-title">Donnez votre avis ! <span>(300 caractères maximum)</span></p>
                <textarea name="commentaire" rows="5" maxlength="300" placeholder="Ecrivez votre commentaire ici.." ></textarea>
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

                $selectreps = $db -> prepare('SELECT id, answer_to, contenu, pseudo, date, gravatar FROM commentaires WHERE idarticle=:idarticle AND answer_to!=0 ORDER BY date ASC');
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
                            echo    "<button class='del_btn' onclick='delcommentPopup(".$value['id'].")'>Supprimer ♥</button>";
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
                                    echo    "<button class='del_btn' onclick='delcommentPopup(".$data2[$key]['id'].")'>Supprimer ♥</button>";
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
            var articleget = "<?=$_GET['article']?>";
        </script>
        
            <script type="text/javascript">
                
                // Afficher un commentaire
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
                    commentaire.innerHTML = document.getElementsByName('commentaire')[0].value;

                    var btns = document.createElement("DIV");
                    btns.className = 'btns';

                    if(admin) {
                        var delbtn = document.createElement("button");
                        delbtn.className = "del_btn";
                        delbtn.innerHTML = "Supprimer ♥";
                        //delbtn.setAttribute("onclick", "delcommentPopup("+id+")");
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
                
                // Envoyer un commentaire à la bdd
                function postComment() {
                    console.log(articleget);
                    var comment = document.getElementsByName('commentaire')[0].value;
                    if(comment !== "") {
                        var postcomment;
                        if (window.XMLHttpRequest) {
                            postcomment = new XMLHttpRequest();
                        } else {
                            postcomment = ActiveXObject('Microsoft.XMLHTTP');
                        }

                        postcomment.open("POST","\\lenouveauminecraft/postacomment.php",true);
                        postcomment.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        postcomment.send("idarticle="+articleget+"&contenu="+comment);
                        document.getElementById("commentaires").insertBefore(insertComment(), document.querySelector('.commentaire:first-child'));                     
                    }            
                }
                    var exists = false;
                
                // Afificher une réponse à un commentaire
                function replyComment(id, previous) {
                        if(!exists) {
                            var input = document.createElement('input');
                            input.type = "hidden";
                            input.name = "answer_to";
                            input.value = id;

                            var repzone = document.createElement('DIV');
                            repzone.className = "repzone";

                            var textinrepzone = document.createElement('p');
                            textinrepzone.innerHTML = 'Répondez à ce commentaire...';
                            textinrepzone.className = 'textinrepzone';   

                            var reptextabout = document.createElement('p');
                            reptextabout.innerHTML = "Vous devez être connecté pour répondre & merci de rester poli quel que soit votre avis :)";
                            reptextabout.className = 'reptextabout';

                            var reptextarea = document.createElement("textarea");
                            reptextarea.className = "reptextarea";

                            var sendrep_btn = document.createElement("button");
                            sendrep_btn.className = "sendrep_btn";
                            sendrep_btn.innerHTML = "Répondre";
                            sendrep_btn.setAttribute("onclick","postReply("+previous+")");

                            var commentaires = document.getElementById("commentaires");

                            repzone.appendChild(textinrepzone);
                            repzone.appendChild(input);
                            repzone.appendChild(reptextarea);
                            repzone.appendChild(sendrep_btn);
                            repzone.appendChild(reptextabout);
                            commentaires.insertBefore(repzone, document.querySelectorAll('.commentaire')[1+previous]);
                            exists = true;
                        }
                }
                
                // Envoyer une réponse de commentaire à la bdd & creer une div de réponse
                function postReply(previous) {
                    var rep = document.getElementsByClassName('reptextarea')[0].value;
                    var id = document.getElementsByName('answer_to')[0].value;
                    var commentaires = document.getElementById("commentaires");
                    var repzone = document.querySelector(".repzone");
                    
                    if(id !== "" && rep !== "") {
                        var postrep;
                        if (window.XMLHttpRequest) {
                            postrep = new XMLHttpRequest();
                        } else {
                            postrep = ActiveXObject('Microsoft.XMLHTTP');
                        }
                        
                        postrep.open("POST","replycomment.php",true);
                        postrep.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        postrep.send("contenu="+rep+"&answer_to="+id);                         
                    
                        var repdiv = document.createElement("DIV");
                        repdiv.className = 'commentaire_reponse';

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
                        commentaire.innerHTML = rep;

                        var btns = document.createElement("DIV");
                        btns.className = 'btns';

                        if(admin) {
                            var delbtn = document.createElement("button");
                            delbtn.className = "del_btn";
                            delbtn.innerHTML = "Supprimer ♥";
                            //delbtn.setAttribute("onclick", "delcommentPopup("+id+")");
                            btns.appendChild(delbtn); 
                            
                        }

                        pseudo.appendChild(user);
                        repdiv.appendChild(img); 
                        repdiv.appendChild(pseudo); 
                        repdiv.appendChild(date); 
                        repdiv.appendChild(commentaire); 
                        repdiv.appendChild(btns);
                        commentaires.insertBefore(repdiv, document.querySelectorAll('.commentaire')[1+previous]);
                        
                        commentaires.removeChild(repzone);
                        exists = false;
                    }
                } 
                    
               function delcommentPopup(id) {
                    var input = document.createElement('input');
                    input.type = "hidden";
                    input.name = "id";
                    input.value = id;
                    
                   var confirmbox = confirm('Voulez vous vraiment supprimer ce commentaire ?');
                    if(confirmbox == true) {
                        var delcomment;
                        if (window.XMLHttpRequest) {
                            delcomment = new XMLHttpRequest();
                        } else {
                            delcomment = ActiveXObject('Microsoft.XMLHTTP');
                        }
                       
                        delcomment.open("POST","delcomment.php",true);
                        delcomment.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        delcomment.send("id="+id); 
                        
                   }
               }
                
            </script>

    </body>
</html>