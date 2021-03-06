<?php 
// On démarre la session
session_start();
// Si l'utilisateur n'est pas connecté
if(!isset($_SESSION['AUTH'])) {
    // Et qu'il y a des cookies enregistrés
    if(isset($_COOKIE['AUTH']) AND isset($_COOKIE['HASH'])) {
        $auth = $_COOKIE['AUTH'];
        $hash = $_COOKIE['HASH'];
        // On inclut le nécessaire à la connexion à la db
        require('includes/connexion.php');
        // On vérifie s'il y a un compte qui existe avec les données en cookie
        $checkvars = $db -> prepare('SELECT rank, email, hash, inscription FROM membres WHERE pseudo=:pseudo AND hash=:hash');
        $checkvars -> execute(array(
            'pseudo' => $auth,
            'hash' => $hash
        ));
        // Si oui, on connecte
        if($checkvars -> rowCount() > 0) {
            while($data = $checkvars->fetch()) {
                // On définit les variables nécessaires au site (rang, pseudo, email pour gravatar, date d'inscription)
                $_SESSION['RANK'] = $data['rank'];
                $_SESSION['AUTH'] = $auth;
                $_SESSION['MD5'] = md5(strtolower(trim($data['email'])));
                $date = explode('-',$data['inscription']);
                $_SESSION['DATE'] = "$date[2].$date[1].$date[0]";
            }
        } else {
            // Sinon on destroy les cookies
            setcookie('AUTH', null, -1);
            setcookie('HASH', null, -1);
        }
    }
}
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - News sur le jeu de type "sandbox"</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
        <?php if(!isset($_SESSION['AUTH'])): ?>
        <style>
            #title {
                width: calc(100% - 96px);
            }
        </style>
        <?php endif ?>
    </head>
    <body>
        <header id="header">
            <div id="header-container">
                <div id="header-inner">
                    <div onclick="toggleMenu()" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a id="title" href="index.php"><h1><span>Nether News</span></h1></a>
                    <?php if(isset($_SESSION['AUTH'])): ?>
                    <a id="notif" onclick="toggleNotif()"><img src="notification.svg"><span></span></a>
                        <a class="login" onclick="toggleProfile()"><img src="usercommentaire.svg"></a>
                    <?php else: ?>
                        <a class="login" href="login.php"><img src="login.svg"></a>
                    <?php endif ?>
                    </a>
                </div>
            </div>
        </header>
        <div id="menu" class="dropdown">
            <div>Menu</div>
            <div id="menu_list">
                <a href="maps/">Maps</a>
                <a href="mods/">Mods</a>
                <a href="versions/">Versions</a>
                <a href="plugins/">Plugins</a>
                <a href="textures/">Textures</a>
                <a href="shaders/">Shaders</a>
                <a href="cheats/">Cheats</a>
                <a href="divers/">Divers</a>
            </div>
        </div>
    <div id="notifs" class="dropdown">
        <div>Notifications</div>
        <div id="notifs_list"><br>Chargement</div>
    </div>
        <?php if(isset($_SESSION['AUTH'])): ?>
            <div id="profile" class="dropdown">
                <div><?=$_SESSION['AUTH']?></div>
                <div id="profile_list">
                    <a href="user/<?=$_SESSION['AUTH']?>/">
                        <img src="http://www.gravatar.com/avatar/<?=$_SESSION['MD5']?>?s=250">
                        Mon compte
                    </a>
                    <?php if($_SESSION['RANK'] > 1): ?>
                        <a class="redaction" href="write.php">Rédaction</a>
                    <?php endif ?>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
        <?php endif ?>
    
        <div id="slide">
            Bonjour et bienvenue sur Nether News! Notre site est en construction, mais nous ne vous retenons pas de lire nos articles. <br>Installez-vous confortablement : de longues heures de lecture vous attendent.
        </div>
        <section id="articles">
            <?php
                include('cache/index.php');
            ?>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
        <script type="text/javascript">
            <?php if(isset($_SESSION['AUTH'])): ?>
                var logged = true;
            <?php else: ?>
                var logged = false;
            <?php endif ?>
        </script>


        <!-- A FAIRE: METTRE CE SCRIPT DANS UN FICHIER EXTERNE -->
        <script type="text/javascript" async defer>
        // Gestion du scroll
        var keys = {37: 1, 38: 1, 39: 1, 40: 1};

        function preventDefault(e) {
          e = e || window.event;
          if (e.preventDefault)
              e.preventDefault();
          e.returnValue = false;  
        }

        function preventDefaultForScrollKeys(e) {
            if (keys[e.keyCode]) {
                preventDefault(e);
                return false;
            }
        }

        function disableScroll() {
            if(window.addEventListener) // older FF
                window.addEventListener('DOMMouseScroll', preventDefault, false);
            window.onwheel = preventDefault; // modern standard
            window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
            window.ontouchmove  = preventDefault; // mobile
            document.onkeydown  = preventDefaultForScrollKeys;
        }

        function enableScroll() {
            if(window.removeEventListener)
                window.removeEventListener('DOMMouseScroll', preventDefault, false);
            window.onmousewheel = document.onmousewheel = null;
            window.onwheel = null;
            window.ontouchmove = null;
            document.onkeydown = null;
        }

        // Toggle le menu
        function toggleMenu() {
            if(menu_shown) {
                menu.style.left = "-320px";
                burger.style.transform = "rotate(0)";
            } else {
                menu.style.left = 0;
                burger.style.transform = "rotate(90deg)";
            }
            menu_shown = !menu_shown;
            if(profile_shown) {
                profile.style.right = "-320px";
                profile_shown = false;
            }
            if(notifs_shown) {
                notifs.style.right = "-320px";
                notifs_shown = false;
            }
        }
            
        // Toggle le profil
        function toggleProfile() {
            if(profile_shown) {
                profile.style.right = "-320px";
            } else {
                profile.style.right = 0;
            }
            profile_shown = !profile_shown;
            if(notifs_shown) {
                notifs.style.right = "-320px";
                notifs_shown = false;
            }
            if(menu_shown) {
                menu.style.left = "-320px";
                menu_shown = false;
            }
        }
            
        // Toggle les notifications
        function toggleNotif() {
            if(notifs_shown) {
                notifs.style.right = "-320px";
            } else {
                notifs.style.right = 0;
            }
            notifs_shown = !notifs_shown;
            if(profile_shown) {
                profile.style.right = "-320px";
                profile_shown = false;
            }
            if(menu_shown) {
                menu.style.left = "-320px";
                menu_shown = false;
            }
            if(!notifs_loaded) {
                // Enlève le point d'alerte
                red_dot.style.opacity = 0;
                // Va chercher et affiche les notifications
                var xhr;
                if(window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                } else {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        notifs_list.innerHTML = "";
                        notifs_loaded = true;
                        var json = JSON.parse(xhr.responseText);
                        for(var i = 0; i < json.length; i++) {
                            var a = document.createElement("a");
                            a.href = json[i].lien;
                            a.innerHTML = json[i].objet;
                            notifs_list.appendChild(a);
                        }
                    }
                };
                xhr.open("GET","get_notifs.php",true);
                xhr.send();
                // Définis les notifications comme "lues"
                var xhr2;
                if(window.XMLHttpRequest) {
                    xhr2 = new XMLHttpRequest();
                } else {
                    xhr2 = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr2.open("GET","notifs_read.php",true);
                xhr2.send();
            }
        }
            
        // Fait bouger la clochette de notifications
        function blinkNotif() {
            red_dot.style.opacity = 1;
            setTimeout(function() {
                red_dot.style.opacity = 0;
            }, 500);
            setTimeout(function() {
                red_dot.style.opacity = 1;
            }, 1000);
        }

        // Au chargement de la page
        document.body.onload = function() {
            // Variables du burger et du menu
            menu = document.getElementById("menu");
            menu_shown = false;
            burger = document.getElementById("hamburger");
            // Variables du profil et des notifs (si connecté)
            if(logged) {
                menu_list = document.getElementById("menu_list");
                profile = document.getElementById("profile");
                profile_shown = false;
                profile_list = document.getElementById("profile_list");
                notifs_loaded = false;
                notif = document.getElementById("notif");
                notifs_list = document.getElementById("notifs_list");
                notifs_shown = false;
                notifs = document.getElementById("notifs");
                clochette = document.querySelector("#notif img");
                red_dot = document.querySelector("#notif span");
                // Vérifie si l'utilisateur a des notifications
                var xhr;
                if(window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                } else {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        if(xhr.responseText == true) {
                            blinkNotif();
                        }
                    }
                };
                xhr.open("GET","check_notif.php",true);
                xhr.send();
            }
        };
        </script>
    </body>
</html>