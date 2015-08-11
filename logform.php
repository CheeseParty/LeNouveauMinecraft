<?php
// LOGFORM.PHP
// Vérification du pseudo et du mdp
session_start();

// Si la requête est valide
if(isset($_POST['pseudo']) AND isset($_POST['password'])) {
    require('includes/connexion.php');

    $conn = $db->prepare('SELECT rank, email, hash, inscription FROM membres WHERE pseudo=? AND actif=1');
    $conn->execute(array($_POST['pseudo']));

    // Si la requête donne un résultat
    if($conn->rowCount() > 0) {
        while($data = $conn->fetch()) {
            // Et que le mot de passe est correct
            if(password_verify($_POST['password'],$data['hash'])) {
                // Si l'utilisateur coche la case "se souvenir de moi"
                if(isset($_POST['rememberbox'])) {
                    $pseudo = $_POST['pseudo'];
                    $password = $data['hash'];
                    // On met ses données en cookie    
                    setcookie('AUTH', $pseudo, strtotime('+14 days'));
                    setcookie('HASH', $password, strtotime('+14 days'));
                }
                $_SESSION['RANK'] = $data['rank'];
                $_SESSION['AUTH'] = $_POST['pseudo'];
                $_SESSION['MD5'] = md5(strtolower(trim($data['email'])));
                $date = explode('-',$data['inscription']);
                $_SESSION['DATE'] = "$date[2].$date[1].$date[0]";
                header("Location: index.php");
                exit;
            } else {
                header("Location: login.php?message=badlogin");
                exit;
            }
        }     
    }
    // Sinon
    else {
        header("Location: login.php?message=badlogin");
        exit;
    }
}
// Sinon
else {
    header("Location: login.php?message=empty");
    exit;
}

