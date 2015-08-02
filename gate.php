<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Portail | Le Nouveau Minecraft - News sur le jeu de type "sandbox"</title>
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
				<a href="index.php">Le Nouveau Minecraft</a>
                <a class="register_link" href="gate.php">Inscription</a>
			</h1>
        </header>
		
        <div id="menu">
			<span>Maps</span>
			<span>Mods</span>
			<span>Plugins</span>
		</div>
        
        <div id="content">
            <p class="form_title">Inscrivez vous !</p>
            <form method="post" action="regform.php">
                <input type="text" class="textbox" name="pseudo" placeholder="Choisissez un pseudo" required="required">
                <input type="password" class="textbox" name="password" placeholder="Choisissez un mdp" required="required">
                <input type="submit" class="form_btn" value="Inscription">
            </form>
        </div>
    </body>
    
   
</html>