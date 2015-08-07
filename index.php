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
						<a class='login logout' href='logout.php'><img src='logout.svg'><span>Déconnexion</span></a>
					<?php else: ?>
						<a class='login' href='login.php'><img src='login.svg'><span>Connexion | Inscription</span></a>
					<?php endif ?>
					</a>
					<?php if(isset($_SESSION['AUTH'])): ?>
						<p class='infoauth'>Connecté en tant que <a href="user/<?=$_SESSION['AUTH']?>/"><?=$_SESSION['AUTH']?></a></p>
		            <?php endif ?>
				</div>
			</div>
		</header>
		<div id="menu">
			<a href="#">Maps</a>
			<a href="#">Mods</a>
			<a href="#">Plugins</a>
		</div>
		<section id="articles">
			<?php // include('cache/cache.php'); ?>
			<article class="map">
				<a style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</a>
			</article>
			<article class="mod">
				<a style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</a>
			</article>
			<article class="plugin">
				<a style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</a>
			</article>
			<article class="version">
				<a style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</a>
			</article>
		</section>
		<footer>
			<div>N</div>
			© "Copyright" Nether News <?=date('Y')?>
		</footer>
		<!-- A FAIRE: METTRE LE SCRIPT DANS UN FICHIER EXTERNE -->
		<script type="text/javascript" async defer>
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
		/*	var article = document.querySelector('article');
			for(var i = 0; i < 5; i++) {
				var copy = article.cloneNode(true);
				document.querySelector('#articles').appendChild(copy);
			}*/
		}
		</script>
	</body>
</html>