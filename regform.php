<?php
    session_start();
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $db = new PDO('mysql:host=localhost;dbname=testnewminecraft','root','',$options);

    if(isset($_POST['pseudo']) AND isset($_POST['password']) AND isset($_POST['password2']) AND isset($_POST['email']) AND ($_POST['password']) == ($_POST['password2']))
    {
        //Verif de l'email & pseudo
        $check = $db -> prepare("SELECT id FROM membres WHERE email=? or pseudo=?");
        $check -> execute(array(
            $_POST['email'],
            $_POST['pseudo']
        ));
        //S'ils existent
        if($check->rowCount > 0)
        {
            //On redirige avec message d'erreur
            header("Location:gate.php?fail=true");
        }
        
        //Sinon on inscrit
        else{
        $register = $db -> prepare("INSERT INTO membres (id, pseudo, password, email) VALUES (:id, :pseudo, :password, :email)");
        $register->execute(array(
            "id" => "",
            "pseudo" => $_POST['pseudo'],
            "password" => $_POST['password'],
            "email" => $_POST['email']
        ));
        $register -> closeCursor();
            
        //Et on redirige à l'accueil
        header("Location:index.php");
    }
    }
       
?>