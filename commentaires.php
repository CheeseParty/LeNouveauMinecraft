<?php 
    session_start();
    $auth = $_SESSION['AUTH'];
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
            <form action="postacomment.php" method="post">
                <textarea name="commentaire" rows="5" maxlength="300" placeholder="Ecrivez votre commentaire ici.." required></textarea>
                  <?php 
                if(isset($_GET['posted'])) {
                    echo "<p class='true'>Votre commentaire a été posté.</p>";
                }
            ?>
                <input type="submit" name="postcomment" value="Commenter" class="form_btn">
            </form>
             votre ip est <?php $ip = $_SERVER['REMOTE_ADDR']; echo"$ip";?>
        </div>
        <div id="commentaires">
            <?php 
                require('includes/connexion.php');
                $selectcomms = $db -> prepare('SELECT contenu, pseudo, date, gravatar FROM commentaires WHERE idarticle=:idarticle ORDER BY date DESC');
                $selectcomms->execute(array(
                    'idarticle' => $_GET['article']
                ));
                while($data = $selectcomms -> fetch()) {
                    $default = urlencode('http://www.hostingpics.net/thumbs/16/63/21/mini_166321defaultavatar.jpg');
                    echo "<div class='commentaire'>";
                    echo    "<img src='http://www.gravatar.com/avatar/".$data['gravatar']."?d=$default'/>";
                    echo    "<span class='pseudo'>".$data['pseudo']." </span>";
                    echo    "<span class='date'>".date('d-m-Y G:i:s', strtotime($data['date']))."</span>";
                    echo    "<span class='contenu'>".$data['contenu']."</span>";
                    echo "</div>";
                }
                    
            ?>
                    
        </div>
        
       
    </body>
</html>