<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Validation de compte | Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="valid.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<!-- Favicons -->
		<?php require('includes/favicons.php'); ?>
		<!-- Fin des favicons -->

		<!-- Métadonnées pour SEO -->
		<!-- Fin  meta pour SEO -->

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
				</div>
			</div>
		</header>
		<div id="menu">
			<a href="#">Maps</a>
			<a href="#">Mods</a>
			<a href="#">Plugins</a>
		</div>
        
        <section id="validzone">
            <?php
            if(isset($_GET['error'])) {
                echo'<p class="validtitle">Erreur lors de la validation !</p> <p class="validinfo">Le compte est déjà activé. <a href="index.php">Retour à l\'accueil</a></p>';
            } else {
                echo'<p class="validtitle">Votre compte a été validé !</p> <p class="validsubtitle">Merci <span>' .$_SESSION["AUTH"]. '</span> d\'avoir validé votre compte <p                   class="validinfo">Vous pouvez maintenant naviguer correctement sur notre site, poster des commentaires sur nos articles ou encore accéder au forum et à                         l\'espace membres.<a href="login.php">Se connecter</a></p>' ;
            }
            ?>
                
            
        </section>
        
        <footer>
			<div>N</div>
			© "Copyright" Nether News <?php echo date('Y'); ?>
		</footer>
        
        <script type="text/javascript">
		// Initialise les variables
		function initVars() {
			menu = document.getElementById("menu");
			burger = document.getElementById("hamburger");
		}

		// Place le menu au bon endroit
		function moveMenu() {
			document.getElementById("menu").style.left = window.getComputedStyle(document.getElementById("header-container")).marginLeft;
		}

		// Toggle le menu
		function initMenu() {
			document.getElementById("hamburger").addEventListener('click', function() {
				if(window.getComputedStyle(menu).top == "-100px") {
					menu.style.top = "70px";
					burger.style.transform = "rotate(90deg)";
				} else {
					menu.style.top = "-100px";
					burger.style.transform = "rotate(0)";
				}
			});
			window.addEventListener('resize', function(){
				moveMenu();
			});
		}


		// Initialisation
		window.onload = function() {
			initVars();
			initMenu();
			moveMenu();
		}
		</script>
    </body>
    