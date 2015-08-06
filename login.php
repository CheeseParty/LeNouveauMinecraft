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
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>  
        <div id="loginbox">
            <header id="header">
                <a id="title" href="index.php">
                    <h1>Nether News</h1>
                </a>
            </header>
            <h2>Connexion</h2>
            <form method="post" action="logform.php">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <div id="loginzone">
                    <label>
                        <input type="checkbox" name="rememberbox" value="1">
                        Se souvenir de moi
                    </label>
                    <input type="submit" class="form_btn" value="Connexion">
                </div>
            </form>
            <hr>
            <h2>Inscription</h2>
            <form method="post" action="regform.php">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>       
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="password2" placeholder="Répétez le mot de passe" required>
                <input type="email" name="email" placeholder="Adresse e-mail valide" required>
                <div class="g-recaptcha" data-sitekey="6LcW5AoTAAAAAEJC_qyBzoLoM_YV-vMumXJroN59"></div>
                <input type="submit" class="form_btn2" value="Inscription">
            </form>
            <footer>
                
                <div>N</div>
                © "Copyright" Nether News <?php echo date('Y');?>
            </footer>
        </div>
        <script type="text/javascript">
        document.body.onload = function() {
        <?php
            if(isset($_GET['message'])) {
                switch ($_GET['message']) {
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
                        $message = "Ce pseudo ou cette adresse e-mail est déjà utilisé.";
                        break;

                    case 'badlogin':
                        $message = "Mauvais identifiants de connexion.";
                        break;

                    case 'sent':
                        $message = "Merci de vous être enregistré. Pour terminer votre inscription, vérifiez votre boite de messagerie pour les instructions d\'activation de votre compte.";
                        break;

                    case 'captcha':
                        $message = "Veuillez cocher la case \"Je ne suis pas un robot\"";
                        break;

                    default:
                        $message = "Une erreur inconnue est survenue. Veuillez réessayer.";
                        break;
                }
                echo "alert('$message');";
            }
        ?>
        }       
        </script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>