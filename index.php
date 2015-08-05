<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="57x57" href="favicons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="favicons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="favicons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="favicons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="favicons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="favicons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="favicons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
		<link rel="manifest" href="favicons/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="favicons/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
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
					<a id="login" href="login.php">
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
			© "Copyright" Nether News <?php echo date('Y'); ?>
		</footer>
<!--
"On l'a fait", se réjouissait ce matin le président Obama, en observant le convoi de péniches décoller. Sa réaction a conduit à l'indignation du côté républicain, qui réclame désormais des excuses pour "propos racistes" et "calomnies". En effet, les péniches étaient noires et d'une taille indécente.
-->
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

		// Toogle le login
		function initLogin() {
			document.getElementById("login").addEventListener('click', function() {
				console.log("Login");
				/* Todo:
					Initialiser la variable du loginbox
					Faire apparaitre / disparaitre
				*/
			});
		}

		// Initialisation
		window.onload = function() {
			initVars();
			initMenu();
			moveMenu();
			initLogin();
			var article = document.querySelector('article');
			for(var i = 0; i < 5; i++) {
				var copy = article.cloneNode(true);
				document.querySelector('#articles').appendChild(copy);
			}
		}
		</script>
	</body>
</html>