<?php
    session_start();
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $db = new PDO('mysql:host=localhost;dbname=testnewminecraft','root','',$options);

    if(isset($_POST['pseudo']) AND isset($_POST['password'])) {
           $conn = $db->prepare("SELECT pseudo FROM membres WHERE pseudo=? AND password=?");
           $conn->execute(array($_POST['pseudo'], $_POST['password']));
           
           if($conn->rowCount() > 0)
           {
               $_SESSION['auth'] = $_POST['pseudo'];
               header("Location:login.php");
           }
           
           else{
               header("Location:gate.php?fail=true");
           }
       }
        
?>