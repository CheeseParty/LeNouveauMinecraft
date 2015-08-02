<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Nouveau Minecraft - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>

		<!-- Métadonnées pour SEO -->
		
		<!-- Fin  meta pour SEO -->

	</head>
	<body>
		<header>
			
            <h1>
                <div id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
				
                <a href="/">Le Nouveau Minecraft</a>
			</h1>
		</header>
		<article>
			<h2>Des péniches dans l'espace</h2>
			<div><img src="https://upload.wikimedia.org/wikipedia/pt/7/71/Minecraft2_logo.png"></div>
			<p>"On l'a fait", se réjouissait ce matin le président Obama, en observant le convoi de péniches décoller. Sa réaction a conduit à l'indignation du côté républicain, qui réclame désormais des excuses pour "propos racistes" et "calomnies". En effet, les péniches étaient noires et d'une taille...</p>
		</article>
		<script type="text/javascript">
		function initHeader() {
			window.addEventListener('scroll', function(){
				if(document.body.scrollTop > 0) {
					document.querySelector('header').style.background = "grey";
				} else {
					document.querySelector('header').style.background = "#25885B";
				}
			});
		}
		window.onload = function() {
			initHeader();
			var article = document.querySelector('article');
			for(var i = 0; i < 2; i++) {
				var copy = article.cloneNode(true);
				document.body.appendChild(copy);
			}
		}
		</script>
	</body>
</html>