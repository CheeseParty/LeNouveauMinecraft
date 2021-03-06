<?php
// VALIDPROCESS.PHP
// Envoi du mail contenant le lien pour la validation du compte Nether News

// Inclusion du code de connexion à la base de donnée
require('includes/connexion.php');
    
// Récupération des variables nécessaires au mail 
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];

// On prépare le mail qui contient le lien d'activation
$destinataire = $email;
$sujet = "Nether News - Activation de votre compte";
$headers = 'MIME-Version: 1.0'."\r\n".
  'Content-type: text/html; charset=utf-8'."\r\n".
  'From: gweedzy@gmail.com'."\r\n".
  'X-Mailer: PHP/' . phpversion();

// Contenu du message qui contient le lien d'activation composé de la clé et du pseudo
$message = '
<!doctype html>
<html>
    <head>
        <title>Validation de votre compte Nether News</title>
        <link href="http://fonts.googleapis.com/css?family=Merriweather:700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet" type="text/css">
       
        <meta charset="utf-8">
        
        <style>
        body {
            background:#e8e8e8;
            font-family: "roboto condensed";
        }
        .mail {
            max-width: 700px;
            width:90%;
            display:block;
            margin:10px auto;
            background:#fff;
             box-shadow: 0 6px 32px -10px #000;

        }


        header {
            background: #27AE60;
            width:100%;
            margin:0 auto;
        }

        header h1 {
            font-size: 30pt;
            margin: 0;
            font-family: "Merriweather";
            color: #fff;
            text-align: center;
            line-height: 100px;

        }
        #title{
             text-decoration: none;
        }
        .mailtitle{
            font-size: 20pt;
            font-family: "Merriweather";
            color: #696969;
            text-align: center;
            margin: 0;
            padding: 15px;
        }

        .mailinfo {
            color: #696969;
            text-align: center;
            font-size:15pt;
            line-height: 20pt;
        }

        #mailcontent {
            width: 80%;
            margin: auto;
            padding-bottom: 30px;
            padding-top: 30px;
        }

        .mail-link {
            color: #318fc8;
            display:inline-block;
        }

        .mail-link:hover {
            color: #136496;
        }

        .mailinfo .cordialement {
            margin: 0;
            padding: 30px;
            display: block;
        }

        .mailinfo .noreply {
            margin: 0;
            padding-bottom: 10px;
            display: block;
            font-size: 9pt;
        }

        footer {
            color: lightgrey;
            background: #525252;
            text-align: center;
            width: 100%;
            padding: 20px 0;
            font-size: 13pt;
           
            margin-top:30px;
        }

        footer div {
            color: #fff;
            font-size: 40pt;
            text-shadow: 4px 0 darkgrey;
            font-family: "Merriweather";
        }

        </style>
    </head>
    
    <body>
        <div class="mail">
            <header id="header">
                <a id="title" href="index.php">
                    <h1>Nether News</h1>
                </a>
            </header>
            
            <div id="mailcontent">
            <p class="mailtitle">Veuillez valider votre compte</p>
            
            <p class="mailinfo">Pour avoir accès à toutes les fonctionnalités de Nether News, merci de valider votre compte en cliquant <a href="validation.php?pseudo=?'.urlencode($pseudo).'&cle='.urlencode($cle).'" class="mail-link">http://www.notresite.fr/validation.php?pseudo='.urlencode($pseudo).'&cle='.urlencode($cle).'>ICI</a> (lien complet en bas de la page)

                
            <span class="cordialement">Cordialement, l\'équipe Nether News</span>
                
                <span class="noreply">Lien : <a href="validation.php?pseudo=?'.urlencode($pseudo).'&cle='.urlencode($cle).'" class="mail-link">http://www.notresite.fr/validation.php?pseudo='.urlencode($pseudo).'&cle='.urlencode($cle).'</a> 
                    <br>
                    Cet e-mail a été envoyé automatiquement, merci de ne pas y répondre. 
                    </span>
            </p>
                
                
        </div>
        <footer>
                <div>N</div>
                © "Copyright" Nether News 2015
            </footer>
        </div>
    </body>
</html>';

// Envoi du mail tenant compte des variables définies plus haut
mail($destinataire, $sujet, $message, $headers);
    
