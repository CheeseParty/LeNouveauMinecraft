<?php 
    session_start();
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Nether News - News sur le jeu de type "sandbox"</title>
		<link rel="stylesheet" href="login.css">
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
					
                        <?php 
                            
                            if(isset($_SESSION['auth'])) {
                               // echo"<span>Connecté en tant que :" .$_SESSION['auth']. "</span>";
                                 echo"<a id='logoff' href='logoff.php'><img src='profile.svg'><span>Déconnexion</span></a>";
                                
                            }
                            
                            else {
                               echo"<a id='login' href='login.php'><img src='profile.svg'><span>Connexion | Inscription</span></a>";
                            }
                        ?>
						
					</a>
				</div>
			</div>
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
</html>