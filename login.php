<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="login.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

		<!-- Métadonnées pour SEO -->
		
		<!-- Fin  meta pour SEO -->

	</head>
    <body>
        <div id="loginbox">
            <p class="form_title">Connectez vous</p>
            
            <form method="post" action="logform.php">
            <input type="text" class="textbox" name="pseudo" placeholder="Nom d'utilisateur" required>
            <input type="password" class="textbox" name="password" placeholder="Mot de passe" required>
               
            <div id="loginzone">
                <label class="css-label"><input type="checkbox" name="rememberbox" value="1"> Se souvenir de moi</label>
                <input type="submit" class="form_btn" value="Connexion">
            </div>
                
            </form>
                  
            <p class="separatorform">---------------------------- ou ----------------------------</p>

<p class="form_title">Inscrivez vous</p>
            <p class="forminfo">(*) = obligatoires</p>
            <form method="post" action="regform.php">
                <input type="text" class="textbox" name="pseudo" placeholder="Nom d'utilisateur" required>       
                <input type="password" class="textbox" name="password" placeholder="Mot de passe" required>
                <input type="password" class="textbox" name="password2" placeholder="Répétez le mot de passe" required>
                <input type="email" class="textbox" name="email" placeholder="Adresse mail valide" required>
                <input type="submit" class="form_btn2" value="Inscription">
            </form>
            
        </div>
        
          
    </body>     
</html>