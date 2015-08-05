<?php
// LOGIN.PHP
// Page de connexion et d'inscription

session_start();
if(isset($_SESSION['AUTH'])) {
	header("Location: index.php");
	exit;
}
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="login.css">
		<link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<?php require('includes/favicons.php'); ?>
		<!-- Métadonnées pour SEO -->
		<!-- Fin  meta pour SEO -->

	</head>
	
    <body>
		<header id="header">
			<a id="title" href="index.php"><h1>Nether News</h1></a>
		</header>
		
		<div id="menu">
			<a href="#">Maps</a>
			<a href="#">Mods</a>
			<a href="#">Plugins</a>
		</div>
   
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
                  
                                                    <hr class="separatorform">

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
        <footer>
			<div>N</div>
			© "Copyright" Nether News <?php echo date('Y'); ?>
            <?php 
                if(isset($_SESSION['auth'])){
                    echo"<p class='session'>Connecté en tant que ".$_SESSION['auth']."</p>";
                }
?>
		</footer>
        <script type="text/javascript">
        document.body.onload = function() {
		<?php
			if(isset($_GET['error'])) {
				switch ($_GET['error']) {
					case 'empty':
						$message = "Veuillez remplir tous les champs.";
						break;

					case 'pseudo':
						$message = "Pseudo invalide.";
						break;

					case 'email':
						$message = "Adresse e-mail invalide.";
						break;

					case 'password':
						$message = "Les deux mots de passe ne correspondent pas.";
						break;

					case 'exist':
						$message = "Ce pseudo ou cette adresse e-mail est déjà utlisé.";
						break;

					case 'badlogin':
						$message = "Mauvais identifiants de connexion.";
						break;

					default:
						$message = "Une errur inconnue est survenue. Veuillez réessayer.";
						break;
				}
				echo "alert('$message');";
			}
		?>
		}       
		</script>
    </body>
</html>