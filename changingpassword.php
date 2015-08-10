<?php
// CHANGINGPASSWORD.PHP 
// Page sur laquelle se termine le changement de mot de passe

// On refuse l'accès à ceux qui n'ont pas cliqué sur le lien du mail
if(!isset($_GET['pseudo']) && !isset($_GET['token'])) {
    header('Location: index.php');
}
// On récupère les variables nécessaires
$pseudo = $_GET['pseudo'];
$token = $_GET['token'];

require('includes/connexion.php');
// On compare les deux tokens (bdd et $_GET)
$comparetoken = $db -> prepare('SELECT changepasskey FROM membres WHERE pseudo=:pseudo');
$comparetoken -> execute(array('pseudo' => $pseudo));

// S'ils sont bons
if($comparetoken->rowCount() > 0) {
    // On demande le nouveau mot de passe
    echo '<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Validation de compte | Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="changepassword.css">
		<link href="http://fonts.googleapis.com/css?family=Merriweather:700" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet" type="text/css">
		<!-- Favicons -->
		<?php require("includes/favicons.php"); ?>
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
        
        <div id="reinit_zone">
            <p class="reinit_title">Réinitialiser votre mot de passe </p>
            <p class="reinit_info">Vous êtes sur cette page si vous avez oublié votre mot de passe et que vous souhaitez en changer. Merci de remplir le formulaire suivant                 correctement pour que la procédure se réalise sans problème.</p>
            <div id="reinit_form">
                <form action="yournewpassword.php?token='.$token.'" method="post">
                    <input type="password" name="newpass" placeholder="Entrez votre nouveau mot de passe" required>
                    <input type="password" name="newpass2" placeholder="Entrez le à nouveau" required>
                    <input type="submit" value="Changer de mdp" class="form_btn">
                </form>
            </div>
        </div>
        
        <footer>
			<div>N</div>
			© "Copyright" Nether News '.date("Y").'
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
			document.getElementById("hamburger").addEventListener("click", function() {
				if(window.getComputedStyle(menu).top == "-100px") {
					menu.style.top = "70px";
					burger.style.transform = "rotate(90deg)";
				} else {
					menu.style.top = "-100px";
					burger.style.transform = "rotate(0)";
				}
			});
			window.addEventListener("resize", function(){
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
</html>';
} else {
    '<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Validation de compte | Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="changepassword.css">
		<link href="http://fonts.googleapis.com/css?family=Merriweather:700" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet" type="text/css">
		<!-- Favicons -->
		<?php require("includes/favicons.php"); ?>
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
        
        <div id="reinit_zone">
            <p class="reinit_title">Les clés ne correspondent pas </p>
            <p class="reinit_info">Assurez vous d\'avoir copié le bon lien, celui que vous avez reçu par e-mail.</p>
        </div>
        
        <footer>
			<div>N</div>
			© "Copyright" Nether News '.date("Y").'
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
			document.getElementById("hamburger").addEventListener("click", function() {
				if(window.getComputedStyle(menu).top == "-100px") {
					menu.style.top = "70px";
					burger.style.transform = "rotate(90deg)";
				} else {
					menu.style.top = "-100px";
					burger.style.transform = "rotate(0)";
				}
			});
			window.addEventListener("resize", function(){
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
</html>';
}


    