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
<p class="form_title">Connectez vous</p>
            <form method="post" action="logform.php">
                <label for="pseudo"></label><input type="text" class="textbox" name="pseudo" placeholder="Votre pseudo" required="required"><br>
                <input type="password" class="textbox" name="password" placeholder="Votre mdp" required="required"><br>
                <input type="submit" class="form_btn" value="Connexion">
            </form>

<p class="form_title">Inscrivez vous</p>
            <p class="info">(*) = obligatoires</p>
            <form method="post" action="regform.php">
                <input type="text" class="textbox" name="pseudo" placeholder="Choisissez un pseudo*" required="required"><br>
                <input type="password" class="textbox" name="password" placeholder="Choisissez un mdp*" required="required"><br>
                <input type="password" class="textbox" name="password2" placeholder="Répétez le mdp*" required="required"><br>
                <input type="email" class="textbox" name="email" placeholder="Votre email valide*" required="required"><br>
                <input type="submit" class="form_btn" value="Inscription">
            </form>
            
            <p class="dejamembre">Déjà membre ?</p>
    </body>     
</html>