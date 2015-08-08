<?php session_start(); ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - News sur le jeu de type "sandbox"</title>
        <link rel="stylesheet" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>
        <header id="header">
            <div id="header-container">
                <div id="header-inner">
                    <div id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a id="title" href="index.php"><h1>Nether News</h1></a>       
                    <?php if(isset($_SESSION['AUTH'])): ?>
                        <a id="settings-btn" class='login'><img src='settings.svg'><span>Paramètres</span></a>
                    <?php else: ?>
                        <a class='login' href='login.php'><img src='login.svg'><span>Connexion | Inscription</span></a>
                    <?php endif ?>
                    </a>
                <!--<?php if(isset($_SESSION['AUTH'])): ?>
                        <p class='infoauth'><span>Connecté en tant que <a href="user/<?=$_SESSION['AUTH']?>/"><?=$_SESSION['AUTH']?></a></span></p>
                    <?php endif ?>-->
                </div>
            </div>
        </header>
        <div id="menu" class="dropdown">
            <a></a>
            <a href="news/">News</a>
            <a href="maps/">Maps</a>
            <a href="mods/">Mods</a>
            <a href="versions/">Versions</a>
            <a href="plugins/">Plugins</a>
            <a href="textures/">Textures</a>
            <a href="shaders/">Shaders</a>
            <a href="cheats/">Cheats</a>
        </div>
        <?php if(isset($_SESSION['AUTH'])): ?>
            <div id="settings" class="dropdown">
                <a></a>
                <a href="user/<?=$_SESSION['AUTH']?>/">
                    <img src="http://www.gravatar.com/avatar/<?=$_SESSION['MD5']?>?s=150">
                    Mon compte
                </a>
                <a href="logout.php">Déconnexion</a>
            </div>
        <?php endif ?>
        <section id="articles">
            <?php
            if(!isset($_GET['cache'])) {
                include('cache/index.php');
            } else {
                switch($_GET['cache']) {
                    case 'news':
                        include('cache/news.php');
                        break;

                    case 'maps':
                        include('cache/maps.php');
                        break;

                    case 'mods':
                        include('cache/mods.php');
                        break;

                    case 'versions':
                        include('cache/versions.php');
                        break;

                    case 'plugins':
                        include('cache/plugins.php');
                        break;

                    case 'textures':
                        include('cache/textures.php');
                        break;

                    case 'shaders':
                        include('cache/shaders.php');
                        break;

                    case 'cheats':
                        include('cache/cheats.php');
                        break;

                    default:
                        include('cache/index.php');
                        break;
                }
            }
            ?>
        </section>
        <footer>
            <div>N</div>
            © "Copyright" Nether News <?=date('Y')?>
        </footer>
        <script type="text/javascript">
            <?php if(isset($_SESSION['AUTH'])): ?>
                var logged = true;
                var rotate = false;
            <?php else: ?>
                var logged = false;
            <?php endif ?>
        </script>


        <!-- A FAIRE: METTRE CE SCRIPT DANS UN FICHIER EXTERNE -->
        <script type="text/javascript" async defer>
        // Place le menu au bon endroit
        function moveMenu() {
            var margin = parseFloat(window.getComputedStyle(document.getElementById("header-container")).marginLeft);
            var padding = parseFloat(window.getComputedStyle(document.getElementById("header-inner")).paddingLeft);
            document.getElementById("menu").style.left = margin+padding+"px";
        }

        // Place les paramètres au bon endroit
        function moveSettings() {
            var margin = parseFloat(window.getComputedStyle(document.getElementById("header-container")).marginLeft);
            var padding = parseFloat(window.getComputedStyle(document.getElementById("header-inner")).paddingLeft);
            document.getElementById("settings").style.right = margin+padding+"px";
        }

        // Toggle le menu
        function initMenu() {
            var burger = document.getElementById("hamburger");
            var menu = document.getElementById("menu");
            document.getElementById("hamburger").addEventListener('click', function() {
                if(window.getComputedStyle(menu).top == "-350px") {
                    menu.style.top = "55px";
                    burger.style.transform = "rotate(90deg)";
                } else {
                    menu.style.top = "-350px";
                    burger.style.transform = "rotate(0)";
                }
            });
        }

        // Toggle les settings
        function initSettings() {
            var settings = document.getElementById("settings");
            var cog = document.querySelector("#settings-btn img");
            document.getElementById("settings-btn").addEventListener('click', function() {
                if(window.getComputedStyle(settings).top == "-240px") {
                    settings.style.top = "55px";
                    if(rotate) {
                        cog.style.transform = "rotate(45deg)";
                        console.log("90");
                    }
                } else {
                    settings.style.top = "-240px";
                    if(rotate) {
                        cog.style.transform = "rotate(0)";
                        console.log("0");
                    }
                }
            });
        }

        // Bouge les menus au resize
        function initResize() {
            window.addEventListener('resize', function(){
                moveMenu();
                if(logged) {
                    moveSettings();
                }
                if(parseInt(window.getComputedStyle(document.body).width) <= 600) {
                    rotate = true;
                } else {
                    rotate = false;
                }
            });
            moveMenu();
            if(logged) {
                moveSettings();
            }
            if(parseInt(window.getComputedStyle(document.body).width) <= 600) {
                rotate = true;
            } else {
                rotate = false;
            }
        }

        // Initialisation
        window.onload = function() {
            initMenu();
            if(logged) {
                initSettings();
            }
            initResize();
        /*  var article = document.querySelector('article');
            for(var i = 0; i < 5; i++) {
                var copy = article.cloneNode(true);
                document.querySelector('#articles').appendChild(copy);
            }*/
        }
        </script>
    </body>
</html>