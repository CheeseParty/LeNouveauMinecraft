<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

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
					<a id="login" href="gate.php">
						<img src="profile.svg">
						<span>Connexion | Inscription</span>
					</a>
				</div>
			</div>
		</header>
		<div id="menu">
			<a href="#">Maps</a>
			<a href="#">Mods</a>
			<a href="#">Plugins</a>
		</div>
		<section id="articles">
			<article class="map">
				<div style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</div>
			</article>
			<article class="mod">
				<div style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</div>
			</article>
			<article class="plugin">
				<div style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</div>
			</article>
			<article class="version">
				<div style="background:url('http://goo.gl/07BGlB') no-repeat;background-size:cover">
					<h2>MAP: <span>It's so huge! Ü</span></h2>
					<span>1.8.7</span>
				</div>
			</article>
			
		</section>
	<!--	<footer>
			CAUPIRAYT lmao
		</footer>  -->
<!--
"On l'a fait", se réjouissait ce matin le président Obama, en observant le convoi de péniches décoller. Sa réaction a conduit à l'indignation du côté républicain, qui réclame désormais des excuses pour "propos racistes" et "calomnies". En effet, les péniches étaient noires et d'une taille indécente.

Classes: exemple

.map {
	border: red
	background rgba(red,0.75)
}

.map {
	border: red
	background rgba(red,0.75)
}
-->
		<script type="text/javascript">
		// Change la couleur du header au scroll
		function initHeader() {
			window.addEventListener('scroll', function() {
				if(document.body.scrollTop > 0) {
					document.getElementById('header').style.background = "#808080";
					document.getElementById('menu').style.background = "#808080";
					document.getElementById('login').style.background = "#9C9C9C";
				} else {
					document.getElementById('header').style.background = "#25885B";
					document.getElementById('menu').style.background = "#25885B";
					document.getElementById('login').style.background = "#31A972";
				}
			});
		}

		// Place le menu au bon endroit
		function moveMenu() {
			document.getElementById("menu").style.left = window.getComputedStyle(document.getElementById("header-container")).marginLeft;
		}

		// Toggle le menu
		function initMenu() {
			document.getElementById("hamburger").addEventListener('click', function(){
				var menu = document.getElementById("menu");
				var burger = document.getElementById("hamburger");
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
			initHeader();
			initMenu();
			moveMenu();
			var article = document.querySelector('article');
			for(var i = 0; i < 5; i++) {
				var copy = article.cloneNode(true);
				document.querySelector('#articles').appendChild(copy);
			}
		}
		</script>
	</body>
</html>