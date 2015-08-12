<?php
// LOGIN.PHP
// Page de connexion et d'inscription

session_start();
if(isset($_SESSION['AUTH'])) {
    header("Location: index.php");
    exit;
}


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
            $message = "<p class='noerror'>Merci de vous être enregistré. Pour terminer votre inscription, vérifiez votre boite de messagerie pour les instructions d'activation de votre compte.</p>";
            break;

        case 'captcha':
            $message = "Veuillez cocher la case \"Je ne suis pas un robot\"";
            break;

        default:
            $message = "Une erreur inconnue est survenue. Veuillez réessayer.";
            break;
    }
}
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nether News - News sur le jeu de type "sandbox"</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="login.css">
        <link href='http://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
        <!-- Favicons -->
        <?php require('includes/favicons.php'); ?>
        <!-- Métadonnées pour SEO -->
    </head>
    <body>  
        
        <?php
        if(isset($message)) {
            echo "<script>var popup = true;</script>";
        } else {
            echo "<script>var popup = false;</script>";
        }
        ?>
        <div id="popuperror">
            <img src="errortriangle.svg">
            <hr class="separator-popup">
            <p id="errormessage-popup">
                <?php 
                if(isset($message)) { 
                    echo "$message";
                }
                ?>
            </p>
            <a class="error_btn" onclick="closePopup()">Fermer</a>
        </div>
        <div id="loginbox">
            <header>
                <a href="index.php">
                    <h1>Nether News</h1>
                </a>
            </header>
            <h2>Connexion</h2>
            <form method="post" action="logform.php">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" maxlength="11" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <div id="loginzone">
                    <label>
                        <input type="checkbox" name="rememberbox" value="1">
                        Se souvenir de moi
                    </label>
                    <input type="submit" class="form_btn" value="Connexion"><br>
                    <a class="forgotpassword" href="changer_mdp.php">Réinitialiser mon mot de passe</a>
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
            function closePopup() {
                document.getElementById('popuperror');
                document.getElementById('loginbox');
                loginbox.style.opacity = "1";
                popuperror.style.zIndex = "-10";
                 popuperror.style.opacity = "0";
            }
            if(popup) {
               document.getElementById('popuperror');
                document.getElementById('loginbox');
                loginbox.style.opacity = "0.5";
                popuperror.style.zIndex = "10";
                popuperror.style.opacity = "1";
            } else {
                closePopup();
            }
        </script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>